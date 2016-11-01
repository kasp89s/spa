<?php

namespace app\controllers;

use app\models\Agency;
use app\models\AgencyLogin;
use app\models\BookingRequest;
use app\models\RoomRates;
use app\models\Town;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\Country;
use app\models\Hotel;
use app\models\Page;
use app\models\Rooms;
use app\models\Slider;
use app\models\Subscribers;
use app\models\Settings;

class SiteController extends AbstractController
{
    public $layout = 'static';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width' => 80,
                'height' => 42,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

	public function init()
	{
//        \Yii::$app->session->remove('agency');
        Yii::$app->view->params['pages'] = $this->reformatPages(Page::find()->all());
		Yii::$app->view->params['slider'] = Slider::find()->orderBy('sort asc')->all();
		Yii::$app->params['settings'] = Settings::find()->one();
	}

    /**
     * Главная.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'main';

        $countries = Country::find()->orderBy('id asc')->all();

        if(empty($_GET['country'])) {
            $currentCountry = Country::find()->orderBy('id asc')->one();
        } else {
            $currentCountry = Country::find()->where(['id' => $_GET['country']])->one();

            if (empty($currentCountry)) {
                $currentCountry = Country::find()->orderBy('id asc')->one();
            }
        }

        $townIds = [];
        foreach ($currentCountry->towns as $town) {
            array_push($townIds, $town->id);
        }

        $query = Hotel::find()
            ->where('top > 0')
            ->andWhere('townId IN ('. implode(',', $townIds) .')');

        if (!empty($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'comment': $query->orderBy('hotel.commentCount desc');
                    break;
                case 'request': $query->orderBy('hotel.requestCount desc');
                    break;
                case 'top': $query->orderBy('hotel.top desc');
                    break;
                default: $query->orderBy('hotel.id desc');
                break;
            }
        }
        $hotels = $query->limit(8)->all();

        return $this->render('index', [
                'countries' => $countries,
                'currentCountry' => $currentCountry,
                'hotels' => $hotels
            ]);
    }

    public function actionPage($alias)
    {
        $this->layout = 'static';

        Yii::$app->view->params['currentAlias'] = $alias;

        return $this->render('static', ['alias' => $alias]);
    }

    public function actionSearch()
    {
		$period = false;
        $notFound = false;
        Yii::$app->view->params['brecrumbs']['title'] = 'Мы нашли:&nbsp; ';

        $query = Hotel::find();
        if (!empty($_GET['search'])) {
            Yii::$app->view->params['brecrumbs']['searchText'] = $_GET['search'];
            Yii::$app->view->params['brecrumbs']['pageName'] = $_GET['search'];
            Yii::$app->view->params['brecrumbs']['pageUrl'] = \yii\helpers\Url::to(['site/search']) . '?' . http_build_query($_GET);
            $query
                ->joinWith('country')
                ->andFilterWhere([
                    'or',
                    ['like', 'town.name', $_GET['search']],
                    ['like', 'country.name', $_GET['search']],
                    ['like', 'hotel.name', $_GET['search']],
					['like', 'hotel.excellence', $_GET['search']],
					['like', 'hotel.expert', $_GET['search']]
            ]);
        }
		
		if (!empty($_GET['from_d']) && !empty($_GET['from_m']) && !empty($_GET['from_y'])) {
			$dateFrom = $_GET['from_y'] . '-' . $_GET['from_m'] . '-' . $_GET['from_d'];
			$dateFrom = date('Y-m-d 00:00:00', strtotime($dateFrom));
		}	
		
		if (!empty($_GET['to_d']) && !empty($_GET['to_m']) && !empty($_GET['to_y'])) {
			$dateTo = $_GET['to_y'] . '-' . $_GET['to_m'] . '-' . $_GET['to_d'];
			$dateTo = date('Y-m-d 00:00:00', strtotime($dateTo));
		}
		
		if (!empty($dateFrom) && !empty($dateTo)) {
            if(strtotime($dateFrom) < time()) {
                $notFound = true;
                Yii::$app->view->params['brecrumbs']['notFound'] = true;
            }

            Yii::$app->view->params['brecrumbs']['period_from'] = $_GET['from_d'] . '.' . $_GET['from_m'] . '.' . $_GET['from_y'];
            Yii::$app->view->params['brecrumbs']['period_to'] = $_GET['to_d'] . '.' . $_GET['to_m'] . '.' . $_GET['to_y'];
			$period = true;
			$query->joinWith('rate');

			$query->andWhere(
                '(room_rates.from <= :dateFrom AND room_rates.to >= :dateTo) OR
                (room_rates.from <= :dateFrom AND room_rates.to <= :dateTo AND room_rates.roomId IN
                 (SELECT room_rates.roomId FROM room_rates WHERE room_rates.from < :dateTo AND room_rates.to >= :dateTo))',
                [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);
			//$query->andWhere('room_rates.from <= :dateFrom AND room_rates.to >= :dateTo', [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);

			//$query->orWhere('room_rates.from <= :dateFrom AND room_rates.to <= :dateTo AND room_rates.roomId IN (SELECT room_rates.roomId FROM room_rates WHERE room_rates.from < :dateTo AND room_rates.to >= :dateTo)', [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);
		}
		
		if (!empty($_GET['quantityType'])) {
            Yii::$app->view->params['brecrumbs']['quantityType'] = RoomRates::getQuantityTypeTranslation($_GET['quantityType']);
			$query->joinWith('rate');
			$query->andWhere('room_rates.quantityType = :quantityType', [':quantityType' => $_GET['quantityType']]);
		}
		
		if (!empty($_GET['supplyType'])) {
			$query->joinWith('rate');
			$query->andWhere('room_rates.supplyType = :supplyType', [':supplyType' => $_GET['supplyType']]);
		}

        if (!empty($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'comment': $query->orderBy('hotel.commentCount desc');
                    break;
                case 'request': $query->orderBy('hotel.requestCount desc');
                    break;
                case 'top': $query->orderBy('hotel.top desc');
                    break;
                default: $query->orderBy('hotel.id desc');
                break;
            }
        }

		$query->groupBy(['`hotel`.`id`']);

        if ($notFound === true) {
            Yii::$app->view->params['totalCount'] = 0;
            return $this->render('search', ['notFound' => $notFound, 'totalCount' => 0]);
        }


        $countQuery = clone $query;
		$totalCount = $countQuery->count();

        if ($totalCount == 0) {
            $notFound = true;
            Yii::$app->view->params['totalCount'] = 0;
            return $this->render('search', ['notFound' => $notFound, 'totalCount' => 0]);
        }

        Yii::$app->view->params['totalCount'] = $totalCount;
        $pages = new Pagination([
                'totalCount' => $totalCount,
                'pageSize' => 15,
                'defaultPageSize' => 15
            ]
        );

        $hotels = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('search', ['hotels' => $hotels, 'pages' => $pages, 'period' => $period, 'params' => [
			'dateFrom' => !empty($dateFrom) ? $dateFrom : false,
			'dateTo' => !empty($dateTo) ? $dateTo : false,
			'quantityType' => $_GET['quantityType'],
			'supplyType' => $_GET['supplyType'],
            'totalCount' => $totalCount,
		]]);
    }

    public function actionList($id)
    {
        $town = Town::find()->where('id = :id', [':id' => $id])->one();
        if (empty($town->id))
            throw new \yii\web\NotFoundHttpException();

        Yii::$app->view->params['brecrumbs']['title'] = $town->name;
        Yii::$app->view->params['brecrumbs']['pageName'] = $town->name;
        Yii::$app->view->params['brecrumbs']['pageUrl'] = \yii\helpers\Url::to(['site/list', 'id' => $town->id]);
        $query = Hotel::find()->where('townId = :id', [':id' => $id]);

        if (!empty($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'comment': $query->orderBy('commentCount desc');
                    break;
                case 'request': $query->orderBy('requestCount desc');
                    break;
                case 'top': $query->orderBy('top desc');
                    break;
                default: $query->orderBy('id desc');
                break;
            }
        }

        $countQuery = clone $query;

        $pages = new Pagination([
                'totalCount' => $countQuery->count(),
                'pageSize' => 15,
                'defaultPageSize' => 15
            ]
        );

        $hotels = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list', ['hotels' => $hotels, 'pages' => $pages]);
    }

    public function actionShares()
    {
        Yii::$app->view->params['brecrumbs']['title'] = 'Aкции и скидки';
        Yii::$app->view->params['brecrumbs']['pageName'] = 'Aкции и скидки';
        Yii::$app->view->params['brecrumbs']['pageUrl'] = \yii\helpers\Url::to(['site/shares']);
        $query = Hotel::find();
        $query->joinWith('deals', true, 'JOIN');

        if (!empty($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'comment': $query->orderBy('commentCount desc');
                    break;
                case 'request': $query->orderBy('requestCount desc');
                    break;
                case 'top': $query->orderBy('top desc');
                    break;
                default: $query->orderBy('id desc');
                    break;
            }
        }
        $countQuery = clone $query;

        $pages = new Pagination([
                'totalCount' => $countQuery->count(),
                'pageSize' => 15,
                'defaultPageSize' => 15
            ]
        );

        $hotels = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list', ['hotels' => $hotels, 'pages' => $pages]);
    }

    public function actionHotel($id)
    {
        $notFound = false;
		$period = false;
		$query = Hotel::find()->where('hotel.id = :id', [':id' => $id]);
		
		if (!empty($_GET['from_d']) && !empty($_GET['from_m']) && !empty($_GET['from_y'])) {
			$dateFrom = $_GET['from_y'] . '-' . $_GET['from_m'] . '-' . $_GET['from_d'];
			$dateFrom = date('Y-m-d 00:00:00', strtotime($dateFrom));
		}	
		
		if (!empty($_GET['to_d']) && !empty($_GET['to_m']) && !empty($_GET['to_y'])) {
			$dateTo = $_GET['to_y'] . '-' . $_GET['to_m'] . '-' . $_GET['to_d'];
			$dateTo = date('Y-m-d 00:00:00', strtotime($dateTo));
		}
		
		if (!empty($dateFrom) && !empty($dateTo)) {
            if(strtotime($dateFrom) < time()) {
                $notFound = true;
                Yii::$app->view->params['brecrumbs']['notFound'] = true;
            }
			$period = true;
            Yii::$app->view->params['brecrumbs']['period_from'] = $_GET['from_d'] . '.' . $_GET['from_m'] . '.' . $_GET['from_y'];
            Yii::$app->view->params['brecrumbs']['period_to'] = $_GET['to_d'] . '.' . $_GET['to_m'] . '.' . $_GET['to_y'];
			$query->joinWith('rate');
            $query->andWhere(
                '(room_rates.from <= :dateFrom AND room_rates.to >= :dateTo) OR
                (room_rates.from <= :dateFrom AND room_rates.to <= :dateTo AND room_rates.roomId IN
                 (SELECT room_rates.roomId FROM room_rates WHERE room_rates.from < :dateTo AND room_rates.to >= :dateTo))',
                [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);
//			$query->andWhere('room_rates.from <= :dateFrom AND room_rates.to >= :dateTo', [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);
//			$query->orWhere('room_rates.from <= :dateFrom AND room_rates.to <= :dateTo AND room_rates.roomId IN (SELECT room_rates.roomId FROM room_rates WHERE room_rates.from < :dateTo AND room_rates.to >= :dateTo)', [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);
		}
		
		if (!empty($_GET['quantityType'])) {
            Yii::$app->view->params['brecrumbs']['quantityType'] = RoomRates::getQuantityTypeTranslation($_GET['quantityType']);
			$query->joinWith('rate');
			$query->andWhere('room_rates.quantityType = :quantityType', [':quantityType' => $_GET['quantityType']]);
		}
		
		if (!empty($_GET['supplyType'])) {
			$query->joinWith('rate');
			$query->andWhere('room_rates.supplyType = :supplyType', [':supplyType' => $_GET['supplyType']]);
		}

		$hotel = $query->one();
		if (empty($hotel)) {
            $notFound = true;
            Yii::$app->view->params['brecrumbs']['notFound'] = true;
            $hotel = Hotel::find()->where('hotel.id = :id', [':id' => $id])->one();
        }

        $params = [
        'dateFrom' => !empty($dateFrom) ? $dateFrom : false,
        'dateTo' => !empty($dateTo) ? $dateTo : false,
        'quantityType' => !empty($_GET['quantityType']) ? $_GET['quantityType'] : false,
        'supplyType' => !empty($_GET['supplyType']) ? $_GET['supplyType'] : false,
        'commissions' => $hotel->commissions,
        'margins' => $hotel->margins,
        'deals' => $hotel->deals,
        'agency' => $hotel->agency,
        ];

        Yii::$app->view->params['brecrumbs']['title'] = $hotel->name;
        Yii::$app->view->params['brecrumbs']['pageName'] = $hotel->name;
        Yii::$app->view->params['brecrumbs']['pageUrl'] = \yii\helpers\Url::to(['site/hotel', 'id' => $id]);
        Yii::$app->view->params['totalCount'] = count(Rooms::getRoomsPrice($hotel->rooms, $params));
        return $this->render('hotel', ['notFound' => $notFound, 'hotel' => $hotel, 'period' => $period, 'params' => $params]);
    }

    private function registerRequest()
    {
        $post = Yii::$app->request->post();

        $request = new BookingRequest();
        foreach ($post['BookingRequest']['name'] as $name) {
            if ($name == '')
                $emptyName = true;
        }
        foreach ($post['BookingRequest']['lastName'] as $name) {
            if ($name == '')
                $emptyLastName = true;
        }
        $post['BookingRequest']['name'] = empty($emptyName) ? json_encode($post['BookingRequest']['name']) : '';
        $post['BookingRequest']['lastName'] = empty($emptyLastName) ? json_encode($post['BookingRequest']['lastName']) : '';
        $post['BookingRequest']['roomId'] = $_GET['room'];
        $post['BookingRequest']['hotelId'] = $_GET['hotel'];
        if ($request->load($post) && $request->validate()) {
            $request->save();

            echo \yii\helpers\BaseJson::encode([
                    'success' => $this->renderPartial('ajax/requestComplete', [])
                ]);
            Yii::$app->end();
        }
        echo \yii\helpers\BaseJson::encode($request->getErrors());

        Yii::$app->end();
    }

    public function actionRequest()
    {
        if (Yii::$app->request->isPost) {
            $this->registerRequest();
        }
        $query = Hotel::find()->where('hotel.id = :id', [':id' => $_GET['hotel']]);
        if (!empty($_GET['from_d']) && !empty($_GET['from_m']) && !empty($_GET['from_y'])) {
            $dateFrom = $_GET['from_y'] . '-' . $_GET['from_m'] . '-' . $_GET['from_d'];
            $dateFrom = date('Y-m-d 00:00:00', strtotime($dateFrom));
        }

        if (!empty($_GET['to_d']) && !empty($_GET['to_m']) && !empty($_GET['to_y'])) {
            $dateTo = $_GET['to_y'] . '-' . $_GET['to_m'] . '-' . $_GET['to_d'];
            $dateTo = date('Y-m-d 00:00:00', strtotime($dateTo));
        }
        if (!empty($dateFrom) && !empty($dateTo)) {
            $period = true;
            Yii::$app->view->params['brecrumbs']['period_from'] = $_GET['from_d'] . '.' . $_GET['from_m'] . '.' . $_GET['from_y'];
            Yii::$app->view->params['brecrumbs']['period_to'] = $_GET['to_d'] . '.' . $_GET['to_m'] . '.' . $_GET['to_y'];
            $query->joinWith('rate');
            $query->andWhere(
                '(room_rates.from <= :dateFrom AND room_rates.to >= :dateTo) OR
                (room_rates.from <= :dateFrom AND room_rates.to <= :dateTo AND room_rates.roomId IN
                 (SELECT room_rates.roomId FROM room_rates WHERE room_rates.from < :dateTo AND room_rates.to >= :dateTo))',
                [':dateFrom' => $dateFrom, ':dateTo' => $dateTo]);
        }
        if (!empty($_GET['quantityType'])) {
            Yii::$app->view->params['brecrumbs']['quantityType'] = RoomRates::getQuantityTypeTranslation($_GET['quantityType']);
            $query->joinWith('rate');
            $query->andWhere('room_rates.quantityType = :quantityType', [':quantityType' => $_GET['quantityType']]);
        }

        if (!empty($_GET['supplyType'])) {
            $query->joinWith('rate');
            $query->andWhere('room_rates.supplyType = :supplyType', [':supplyType' => $_GET['supplyType']]);
        }
        $hotel = $query->one();
        if (empty($hotel))
            throw new \yii\web\NotFoundHttpException("Error page not found.");

        $params = [
            'dateFrom' => !empty($dateFrom) ? $dateFrom : false,
            'dateTo' => !empty($dateTo) ? $dateTo : false,
            'quantityType' => !empty($_GET['quantityType']) ? $_GET['quantityType'] : false,
            'supplyType' => !empty($_GET['supplyType']) ? $_GET['supplyType'] : false,
            'roomId' => !empty($_GET['room']) ? $_GET['room'] : false,
            'commissions' => $hotel->commissions,
            'margins' => $hotel->margins,
            'deals' => $hotel->deals,
            'agency' => $hotel->agency,
        ];
        $rooms = Rooms::getRoomsPrice($hotel->rooms, $params);
        $room = $rooms[$params['roomId']];

        Yii::$app->view->params['brecrumbs']['title'] = 'Бронирование:&nbsp; ';
        Yii::$app->view->params['brecrumbs']['searchText'] = $room['name'];
        Yii::$app->view->params['brecrumbs']['townUrl'] = \yii\helpers\Url::to('/list/' . $hotel->id);
        Yii::$app->view->params['brecrumbs']['town'] = $hotel->town->name;
        Yii::$app->view->params['brecrumbs']['hotelUrl'] = \yii\helpers\Url::to('/hotel/' . $hotel->id);
        Yii::$app->view->params['brecrumbs']['hotel'] = $hotel->name;

        return $this->render('request', ['hotel' => $hotel, 'room' => $room, 'params' => $params]);
    }

	public function actionSubscribe()
	{
		$model = new Subscribers();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->save();
            echo \yii\helpers\BaseJson::encode(['success' => 'Спасибо за подписку']);
		} else {
			$errors = $model->getErrors();
			echo \yii\helpers\BaseJson::encode(['error' => implode('', $errors['email'])]);
		}
		
		Yii::$app->end();
	}

    protected function reformatPages($pages)
    {
        $result = [];
        foreach ($pages as $page) {
            $result[$page->alias] = $page;
        }

        return $result;
    }

    public function actionAgencyLogin()
    {
        return $this->goHome();
    }

    public function actionAgencyLoginValidate()
    {
        $model = new AgencyLogin();
        $request = \Yii::$app->getRequest();
        $model->load($request->post());
        $model->login();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \yii\widgets\ActiveForm::validate($model);
    }

    public function actionAgencyRegistrationValidate()
    {
        $model = new Agency();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
    }

    public function actionAgencyRegistration()
    {
        $model = new Agency();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            $authKey = uniqid();
            $model->authKey = $authKey;
            $model->password = md5($model->password);
            $model->password_confirm = $model->password;
            $model->save();

            $mailer = new \PHPMailer();
            $mailer->setFrom(Yii::$app->params['adminEmail']);
            $mailer->addAddress($model->email);
            $mailer->isHTML(true);

            $mailer->Subject = 'Подтверждение регистрации';
            $mailer->Body = $this->renderPartial(
                'emailTemplates/registrationMail',
                [
                    'authKey' => $authKey,
                ]
            );
            $mailer->AltBody = $authKey;
            if (!$mailer->send()) {
                throw new \Exception('Mailer Error: ' . $mailer->ErrorInfo);
            }

            echo \yii\helpers\BaseJson::encode($model->getErrors());
            Yii::$app->end();
        }
    }

    public function actionConfirmAgency($code)
    {
        $model = Agency::find()->where(['authKey' => $code])->one();

        if (empty($model))
            throw new \yii\web\NotFoundHttpException();

        $model->authKey = null;
        $model->confirm = 1;
        $model->password_confirm = $model->password;
        $model->save();

        return $this->render('confirmAgency', ['model' => $model]);
    }
}
