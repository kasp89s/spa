<?php
namespace app\controllers;

use app\models\Country;
use app\models\Hotel;
use app\models\HotelCommission;
use app\models\HotelDeals;
use app\models\HotelAgency;
use app\models\HotelMainMedication;
use app\models\HotelMargin;
use app\models\HotelSecondaryMedication;
use app\models\HotelServices;
use app\models\MedicalBase;
use app\models\RoomRates;
use app\models\Rooms;
use app\models\Town;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use Yii;

$phpMailer = Yii::getAlias('@vendor/PHPExcel/Classes/PHPExcel.php');
require_once($phpMailer);

class HotelController extends AbstractController
{
    const FROM = 0;

    const TO = 1;

    const ROOM_NAME = 2;

    const quantityType = 3;

//    const BB = 4;
//
//    const HB = 5;
//
//    const FB = 6;

    const HBT = 4;

    const FBT = 5;

    public $layout = 'main';

    public $title = 'Отели';

    public function actionImport()
    {
          $PHPExcel_file = \PHPExcel_IOFactory::load($_FILES["excel"]["tmp_name"]);
          $array = $PHPExcel_file->setActiveSheetIndex(0)->toArray(); // выгружаем данные из объекта в массив

          foreach ($array as $key => $row) {
              if ($key == 0)
                  continue;
              if (empty($row[self::FROM]))
                  break;

              $model = Rooms::find()->where(
                  'hotelId = :id AND name = :name',
                  [':id' => $_POST['hotelId'], ':name' => $row[self::ROOM_NAME]]
              )->one();

              if (empty($model)) {
                  $model = new Rooms();
                  $model->hotelId = $_POST['hotelId'];
                  $model->name = $row[self::ROOM_NAME];
                  $model->save();
                  $rateHBT = new RoomRates();
                  $rateHBT->roomId = $model->id;
                  $rateHBT->quantityType = $row[self::quantityType];
                  $rateHBT->supplyType = 'HBT';
//                  $rateHBT->name = $row[self::ROOM_NAME];
                  $rateHBT->value = $row[self::HBT];
                  $rateHBT->from = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::FROM])));
                  $rateHBT->to = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::TO])));
                  if (!$rateHBT->validate())
                      throw new \Exception(var_export($rateHBT->getErrors(), true));

                  $rateHBT->save();

                  $rateFBT = new RoomRates();
                  $rateFBT->roomId = $model->id;
                  $rateFBT->quantityType = $row[self::quantityType];
                  $rateFBT->supplyType = 'FBT';
//                  $rateFBT->name = $row[self::ROOM_NAME];
                  $rateFBT->value = $row[self::FBT];
                  $rateFBT->from = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::FROM])));
                  $rateFBT->to = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::TO])));
                  if (!$rateFBT->validate())
                      throw new \Exception(var_export($rateFBT->getErrors(), true));

                  $rateFBT->save();
              } else {
                  $rateHBT = RoomRates::find()->where(
                        '`roomId` = :id AND `quantityType` = :quantityType AND `supplyType` = :supplyType AND `from` = :from AND `to` = :to ',
                            [
                                ':id' => $model->id,
                                ':quantityType' => $row[self::quantityType],
                                ':supplyType' => 'HBT',
                                ':from' => date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::FROM]))),
                                ':to' => date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::TO]))),
                            ]
                    )->one();

                  if (empty($rateHBT)) {
                      $rateHBT = new RoomRates();
                  }
                  $rateHBT->roomId = $model->id;
                  $rateHBT->quantityType = $row[self::quantityType];
                  $rateHBT->supplyType = 'HBT';
//                  $rateHBT->name = $row[self::ROOM_NAME];
                  $rateHBT->value = $row[self::HBT];
                  $rateHBT->from = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::FROM])));
                  $rateHBT->to = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::TO])));
                  if (!$rateHBT->validate())
                      throw new \Exception(var_export($rateHBT->getErrors(), true));

                  $rateHBT->save();

                  $rateFBT = RoomRates::find()->where(
                        '`roomId` = :id AND `quantityType` = :quantityType AND `supplyType` = :supplyType AND `from` = :from AND `to` = :to ',
                            [
                                ':id' => $model->id,
                                ':quantityType' => $row[self::quantityType],
                                ':supplyType' => 'FBT',
                                ':from' => date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::FROM]))),
                                ':to' => date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::TO]))),
                            ]
                    )->one();
                  if (empty($rateFBT)) {
                      $rateFBT = new RoomRates();
                  }
                  $rateFBT->roomId = $model->id;
                  $rateFBT->quantityType = $row[self::quantityType];
                  $rateFBT->supplyType = 'FBT';
//                  $rateFBT->name = $row[self::ROOM_NAME];
                  $rateFBT->value = $row[self::FBT];
                  $rateFBT->from = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::FROM])));
                  $rateFBT->to = date('Y-m-d 00:00:00', strtotime($this->reformatFuckingDate($row[self::TO])));
                  if (!$rateFBT->validate())
                      throw new \Exception(var_export($rateFBT->getErrors(), true));

                  $rateFBT->save();
              }
          }

        Yii::$app->response->redirect(array('hotel/roomlist?id=' . $_POST['hotelId']));
        Yii::$app->end();
    }

    public function actionIndex()
    {
        $records = Hotel::find()->orderBy('id desc')->all();

        $margin = new HotelMargin();

        $commission = new HotelCommission();

        $deals = new HotelDeals();

        $agency = new HotelAgency();

        if ($commission->load(Yii::$app->request->post()) && $commission->validate()) {
            $commission->from = date('Y-m-d H:i:s', strtotime($commission->from));
            $commission->to = date('Y-m-d H:i:s', strtotime($commission->to));
            $commission->save();
            return $this->redirect(Yii::$app->request->referrer);
        }
		
        if ($margin->load(Yii::$app->request->post()) && $margin->validate()) {
            $margin->from = date('Y-m-d H:i:s', strtotime($margin->from));
            $margin->to = date('Y-m-d H:i:s', strtotime($margin->to));
            $margin->save();
            return $this->redirect(Yii::$app->request->referrer);
        }

        if ($deals->load(Yii::$app->request->post()) && $deals->validate()) {
            $deals->from = date('Y-m-d H:i:s', strtotime($deals->from));
            $deals->to = date('Y-m-d H:i:s', strtotime($deals->to));
            $deals->save();
            return $this->redirect(Yii::$app->request->referrer);
        }

        if ($agency->load(Yii::$app->request->post()) && $agency->validate()) {
            $agency->from = date('Y-m-d H:i:s', strtotime($agency->from));
            $agency->to = date('Y-m-d H:i:s', strtotime($agency->to));
            $agency->save();
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('index',
            [
                'title' => $this->title,
                'records' => $records,
                'commission' => $commission,
                'margin' => $margin,
                'deals' => $deals,
                'agency' => $agency,
            ]
        );
    }

    public function actionRoomlist($id)
    {
        $model = Hotel::findOne($id);

        $this->title = 'Номера отеля ' . $model->name;

        $records = Rooms::find()->where('hotelId = :id', [':id' => $id])->all();

        return $this->render('roomlist',
            [
                'title' => $this->title,
                'records' => $records,
            ]
        );
    }

    /**
     * Создать отель.
     *
     * @return string
     */
    public function actionCreate()
    {
        $this->title = 'Создать отель';

        $countries = Country::find()->orderBy('id desc')->all();
        $model = new Hotel();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->photos = json_encode([]);
            $model->save();
            $path = Yii::getAlias('@webroot') . '/../uploads/hotel/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }
            $model->photos = UploadedFile::getInstances($model, 'photos');
            $photosArray = [];
            foreach ($model->photos as $file) {
                $photosArray[] = $file->baseName . '.' . $file->extension;
                $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
            }
            $model->photos = json_encode($photosArray);
            $model->save();

            if (!empty($_POST['mainMedication'])) {
                $this->rewriteMedication($_POST['mainMedication'], $model->id, 'main');
            }
            if (!empty($_POST['secondaryMedication'])) {
                $this->rewriteMedication($_POST['secondaryMedication'], $model->id, 'secondary');
            }

            if (!empty($_POST['services'])) {
                $this->rewriteServices($_POST['services'], $model->id);
            }

            if (!empty($_POST['MedicalBase'])) {
                foreach ($_POST['MedicalBase'] as $key => $medicalBaseData) {
                    $medicalBase = new MedicalBase();
                    $medicalBase->hotelId = $model->id;
                    $medicalBase->title = $medicalBaseData['title'];
                    $medicalBase->description = $medicalBaseData['description'];
                    $medicalBase->video = $medicalBaseData['video'];
                    $path = Yii::getAlias('@webroot') . '/../uploads/medicalBase/' . $model->id;

                    if (!is_dir($path)) {
                        BaseFileHelper::createDirectory($path);
                    }
                    $uploadPhotos = UploadedFile::getInstances($medicalBase, "image$key");

                    if (!empty($uploadPhotos)) {
                        foreach ($uploadPhotos as $file) {
                            $photo = uniqid() . '.' . $file->extension;
                            $file->saveAs($path . '/' .$photo);
                            $medicalBase->image = $photo;
                        }
                    }

                    if ($medicalBase->validate()) {
                        $medicalBase->save();
                    } else {
                        var_dump($medicalBase->getErrors()); exit;
                    }
                }
            }

            Yii::$app->response->redirect(array('hotel/index'));
        }
        return $this->render('create', [
                'title' => $this->title,
                'model' => $model,
                'countries' => $countries,
            ]);
    }

    /**
     * Редактировать отель.
     *
     * @return string
     */
    public function actionEdit($id)
    {
        $this->title = 'Редактировать отель';

        $countries = Country::find()->orderBy('id desc')->all();
        $model = Hotel::findOne($id);
        $photos = json_decode($model->photos, true);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $path = Yii::getAlias('@webroot') . '/../uploads/hotel/' . $model->id;
            if (!is_dir($path)) {
                BaseFileHelper::createDirectory($path);
            }

            $uploadPhotos = UploadedFile::getInstances($model, 'photos');

            if (!empty($uploadPhotos)) {

                foreach ($uploadPhotos as $file) {
                    $photos[] = $file->baseName . '.' . $file->extension;
                    $file->saveAs($path . '/' . $file->baseName . '.' . $file->extension);
                }
            }
            $model->photos = json_encode($photos);
            $model->save();

            if (!empty($_POST['mainMedication'])) {
                $this->rewriteMedication($_POST['mainMedication'], $id, 'main');
            }
            if (!empty($_POST['secondaryMedication'])) {
                $this->rewriteMedication($_POST['secondaryMedication'], $id, 'secondary');
            }

            if (!empty($_POST['services'])) {
                $this->rewriteServices($_POST['services'], $id);
            }

            if (!empty($_POST['MedicalBase'])) {
                foreach ($_POST['MedicalBase'] as $key => $medicalBaseData) {
                    $medicalBase = new MedicalBase();
                    $medicalBase->hotelId = $id;
                    $medicalBase->title = $medicalBaseData['title'];
                    $medicalBase->description = $medicalBaseData['description'];
                    $medicalBase->video = $medicalBaseData['video'];
                    $path = Yii::getAlias('@webroot') . '/../uploads/medicalBase/' . $model->id;

                    if (!is_dir($path)) {
                        BaseFileHelper::createDirectory($path);
                    }
                    $uploadPhotos = UploadedFile::getInstances($medicalBase, "image$key");

                    if (!empty($uploadPhotos)) {
                        foreach ($uploadPhotos as $file) {
                            $photo = uniqid() . '.' . $file->extension;
                            $file->saveAs($path . '/' .$photo);
                            $medicalBase->image = $photo;
                        }
                    }

                    if ($medicalBase->validate()) {
                        $medicalBase->save();
                    } else {
                        var_dump($medicalBase->getErrors()); exit;
                    }
                }
            }

            Yii::$app->response->redirect(array('hotel/index'));
        }
        return $this->render('edit', [
                'title' => $this->title,
                'model' => $model,
                'countries' => $countries,
            ]);
    }

    private function rewriteServices($data, $hotelId)
    {

        HotelServices::deleteAll('hotelId = :hotelId', [':hotelId' => $hotelId]);
        foreach ($data as $service) {
            if (empty($service['id'])) {
                continue;
            }

            $hotelService = new HotelServices();
            $hotelService->hotelId = $hotelId;
            $hotelService->serviceId = $service['id'];
            $hotelService->description = $service['description'];
            if ($hotelService->validate()) {
                $hotelService->save();
            } else {
                var_dump($hotelService->getErrors()); exit;
            }

        }
    }

    private function rewriteMedication($data, $hotelId, $type)
    {
        if ($type == 'main') {
            HotelMainMedication::deleteAll('hotelId = :hotelId', [':hotelId' => $hotelId]);
        } elseif ($type == 'secondary') {
            HotelSecondaryMedication::deleteAll('hotelId = :hotelId', [':hotelId' => $hotelId]);
        } else {
            return;
        }


        foreach ($data as $medicationId) {
            if ($type == 'main') {
                $relation = new HotelMainMedication();
            } elseif ($type == 'secondary') {
                $relation = new HotelSecondaryMedication();
            } else {
                continue;
            }
            $relation->hotelId = $hotelId;
            $relation->medicationId = $medicationId;
            $relation->save();
        }
    }

    /**
     * Удаление фотографий.
     */
    public function actionPhotoremove()
    {
        $post = Yii::$app->request->post();
        $model = Hotel::findOne($post['id']);
        $photos = json_decode($model->photos, true);

        foreach ($photos as $key => $value) {
            if ($post['photo'] == $value) {
                unset($photos[$key]);
                unlink(Yii::getAlias('@webroot') . '/../uploads/hotel/' . $model->id . '/' . $post['photo']);
            }
        }

        $model->photos = json_encode($photos);
        $model->save();

        echo \yii\helpers\BaseJson::encode([]);
        Yii::$app->end();
    }

    /**
     * Удалить отель.
     *
     * @param $id
     */
    public function actionRemove($id)
    {
        $model = Hotel::findOne($id);
        $model->delete();
        Yii::$app->response->redirect(array('hotel/index'));
    }

    /**
     * Удалить коммисию.
     *
     * @param $id
     */
    public function actionCommissionremove($id)
    {
        $model = HotelCommission::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удалить коммисию.
     *
     * @param $id
     */
    public function actionRemoveBase($id)
    {
        $model = MedicalBase::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удалить коммисию.
     *
     * @param $id
     */
    public function actionMarginremove($id)
    {
        $model = HotelMargin::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удалить коммисия агенств.
     *
     * @param $id
     */
    public function actionAgencyRemove($id)
    {
        $model = HotelAgency::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Удалить спецпредложение.
     *
     * @param $id
     */
    public function actionDealremove($id)
    {
        $model = HotelDeals::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    private function reformatFuckingDate($date)
    {
        $tmpDate = explode('-', $date);
        if (!empty($tmpDate[1])) {
            $year = (strlen($tmpDate[2]) == 2) ? '20' . $tmpDate[2] : $tmpDate[2];
            return $tmpDate[1] . '-' . $tmpDate[0] . '-' . $year;
        }
        $tmpDate = explode('.', $date);
        if (!empty($tmpDate[1])) {
            $year = (strlen($tmpDate[2]) == 2) ? '20' . $tmpDate[2] : $tmpDate[2];
            return $tmpDate[0] . '-' . $tmpDate[1] . '-' . $year;
        }

        $tmpDate = explode('/', $date);
        if (!empty($tmpDate[1])) {
            $year = (strlen($tmpDate[2]) == 2) ? '20' . $tmpDate[2] : $tmpDate[2];
            return $tmpDate[0] . '-' . $tmpDate[1] . '-' . $year;
        }
    }

    private function fixDate($row)
    {
        $row[self::FROM] = str_replace('.', '-', $row[self::FROM]);
        $row[self::FROM] = str_replace('/', '-', $row[self::FROM]);
        $row[self::TO] = str_replace('.', '-', $row[self::TO]);
        $row[self::TO] = str_replace('/', '-', $row[self::TO]);

        return $row;
    }
}
