<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property integer $id
 * @property integer $hotelId
 * @property string $name
 * @property string $included
 * @property string $liveable
 * @property string $photos
 * @property string $viewFrom
 * @property string $features
 * @property string $title
 * @property string $description
 *
 * @property RoomRates[] $roomRates
 * @property Hotel $hotel
 */
class Rooms extends \yii\db\ActiveRecord
{
    private static $_commissions;

    private static $_margin;

    private static $_deals;

    private static $_agency;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotelId', 'name'], 'required'],
            [['hotelId', 'DrInspection', 'drinkingCure'], 'integer'],
            [['photos'], 'file', 'extensions' => 'gif, jpg, png', 'maxFiles' => 20],
            [['included', 'features', 'description', 'procedures'], 'string'],
            [['name', 'viewFrom', 'title', 'video'], 'string', 'max' => 255],
            [['liveable'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotelId' => 'Отель',
            'name' => 'Назание номера',
            'included' => 'Что включает в себя номер',
            'liveable' => 'Вместимость номера',
            'photos' => 'Фотографии номера',
            'video' => 'Видео',
            'viewFrom' => 'Вид из номера',
            'features' => 'Особенности номера',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'DrInspection' => 'Осмотры доктора',
            'procedures' => 'Лечебных процедур',
            'drinkingCure' => 'питьевой курс',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomRates()
    {
        return $this->hasMany(RoomRates::className(), ['roomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotelId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncludes()
    {
        return $this->hasMany(RoomInclude::className(), ['roomId' => 'id']);
    }

    public static function getIncludeTranslate($count)
    {
		$count = (int) $count;
        switch ($count) {
            case 1: return 'Одномесный номер';
                break;
            case 2: return 'Двухместный номер';
                break;
			case 3: return 'Трехместный номер';
                break;
            default: return 'Номер';
                break;
        }
    }

    public static function selectCommissions($params) {
        $result = [];
        foreach ($params['commissions'] as $commission)
        {
            if ($commission->to < $params['dateFrom'] || $commission->from > $params['dateTo'])
                continue;

            $result[] = $commission;
        }

        self::$_commissions = $result;

        $result = [];
        foreach ($params['margins'] as $margin)
        {
            if ($margin->to < $params['dateFrom'] || $margin->from > $params['dateTo'])
                continue;

            $result[] = $margin;
        }

        self::$_margin = $result;

        $result = [];
        foreach ($params['deals'] as $deal)
        {
            if ($deal->to < $params['dateFrom'] || $deal->from > $params['dateTo'])
                continue;

            if ($deal->type == 'days' && $deal->from <= $params['dateFrom'] &&  $deal->to >= $params['dateTo']) {
                $result[] = $deal;
            } elseif ($deal->type == 'percent') {
                $result[] = $deal;
            }
        }
        self::$_deals = $result;

        $result = [];
        foreach ($params['agency'] as $agency)
        {
            if ($agency->to < $params['dateFrom'] || $agency->from > $params['dateTo'])
                continue;

            $result[] = $agency;
        }

        self::$_agency = $result;
    }

	public static function getRoomsPrice($rooms, $params, $selectMinimal = false)
	{
        self::selectCommissions($params);

		$issetEXB = false;
		$result = [];
        $prices = [];
		foreach ($rooms as $room) {
			$photos = !empty($room->photos) ? json_decode($room->photos) : [];
			foreach ($room->roomRates as $rate) {

				if ($rate->from > $params['dateTo'] || $rate->to < $params['dateFrom'])
					continue;

				if (!empty($params['quantityType']) && $rate->quantityType != $params['quantityType']) {
					if (!($params['quantityType'] == 'EXB' && $rate->quantityType == 'DBL')) {
												continue;
					}
				}

				if (!empty($params['supplyType']) && $rate->supplyType != $params['supplyType'])
					continue;

				$price = $rate->value;
				
				if ($rate->quantityType == 'DBL')
					$price = $rate->value * 2;
				
				if ($rate->quantityType == 'EXB')
					$issetEXB = true;


                $prices[$rate->roomId . $rate->supplyType . $rate->quantityType] =
                    !empty($prices[$rate->roomId . $rate->supplyType . $rate->quantityType]) ? $prices[$rate->roomId . $rate->supplyType . $rate->quantityType] + $price : $price;
				$result[$rate->roomId . $rate->supplyType . $rate->quantityType][] = [
						'id' => $rate->id,
						'roomId' => $rate->roomId,
						'supplyType' => $rate->supplyType,
						'quantityType' => $rate->quantityType,
						'name' => $room->name,
						'features' => $room->features,
						'viewFrom' => $room->viewFrom,
						'DrInspection' => $room->DrInspection,
						'procedures' => $room->procedures,
						'drinkingCure' => $room->drinkingCure,
						'liveable' => $room->liveable,
						'photo' => isset($photos[0]) ? $photos[0] : false,
						'value' => $price,
						'from' => $rate->from,
						'to' => $rate->to,
					];
			}
//            echo "<pre>"
//                . var_export($result, true) .
//                "</pre>";
		}

        if ($selectMinimal) {
            $minPrice = array_search(min($prices), $prices);
            $result = [$result[$minPrice]];
        }

		// Если выборка включает 3 человека считаем цену DBL * 2 + EXB.
		if ($issetEXB) {
			$result = self::calculateEXB($result, $params);
		}

		$result = self::calculatePrice($result, $params);
//        echo "<pre>"
//            . var_export($result, true) .
//            "</pre>";
		return $result;
	}
	
	private static function calculateEXB($data, $params)
	{
		$EXB = [];
		foreach ($data as $key => $price) {
			$pos = strripos($key, 'EXB');
			if ($pos !== false) {
				$DBL = $data[str_replace('EXB', 'DBL', $key)];
				foreach ($price as $i => $item) {
					$data[$key][$i]['value'] = $item['value'] + $DBL[$i]['value'];
				}
				
				if ($params['quantityType'] == 'EXB') {
					unset($data[str_replace('EXB', 'DBL', $key)]);
				}
			}
		}

		return $data;
	}
	
	public static function calculatePrice($data, $params)
	{

		$intervalTotal = date_diff(date_create($params['dateFrom']), date_create($params['dateTo']));
		// общее количество дней

		$result = [];
		foreach ($data as $key => $priceData) {
					$totalDays = $intervalTotal->days;
					if (empty($result[$priceData[0]['roomId']])) {
						$result[$priceData[0]['roomId']] = [
							"id" => $priceData[0]['roomId'],
							"name" => $priceData[0]['name'],
							'features' => $priceData[0]['features'],
							'viewFrom' => $priceData[0]['viewFrom'],
                            'DrInspection' => $priceData[0]['DrInspection'],
                            'procedures' => $priceData[0]['procedures'],
                            'drinkingCure' => $priceData[0]['drinkingCure'],
							'liveable' => $priceData[0]['liveable'],
							'photo' => $priceData[0]['photo'],
							'price' => [
								$key => [
									"supplyType" => $priceData[0]['supplyType'],
									"quantityType" => $priceData[0]['quantityType'],
									'totalValue' => 0,
									'value' => 0,
								]
							]
						];
					} else {
						$result[$priceData[0]['roomId']]['price'][$key] = [
									"supplyType" => $priceData[0]['supplyType'],
									"quantityType" => $priceData[0]['quantityType'],
                                    'totalValue' => 0,
									'value' => 0,
								];
					}

				foreach ($priceData as $price) {
					$interval = date_diff(date_create($params['dateFrom']), date_create($price['to']));

                    // В этом случае мы считаем первый хвостик.
					if ($totalDays >= $interval->days) {
                        $totalValue = self::calculateTotalValue($interval->days, $params['dateFrom'], $price['value']);

						$result[$price['roomId']]['price'][$key]['value']+= $totalValue['price'];
						$result[$price['roomId']]['price'][$key]['totalValue']+= $totalValue['priceWithoutDeals'];
						$totalDays-= $interval->days;
                    // В этом случае мы считаем второй хвостик или полный период.
					} else {
                        $from = (strtotime($price['from']) < strtotime($params['dateFrom'])) ? $params['dateFrom'] : $price['from'];

                        $totalValue = self::calculateTotalValue($totalDays, $from, $price['value']);

                        $result[$price['roomId']]['price'][$key]['value']+= $totalValue['price'];
                        $result[$price['roomId']]['price'][$key]['totalValue']+= $totalValue['priceWithoutDeals'];
					}

				}
		}

		return $result;
	}

    /**
     * Считаем цену за период с учетом коммисии, маржы, и акций.
     */
    public static function calculateTotalValue($countDays, $dateFrom, $price)
    {
        $result = [
            'price' => 0,
            'priceWithoutDeals' => 0,
        ];

        // Внимание на 1 день мешьше цена идет за ночи!!!
        for ($i = 0; $i < $countDays; $i++) {
            $time = strtotime($dateFrom);
            // Получаем каждый день из ценового периода
            $date = date('Y-m-d H:i:s', $time + ($i * 60 * 60 * 24));

            $commissionIncrease = 0;
            $marginIncrease = 0;
            $dealsDiscount = 0;
            $agencyIncrease = 0;

            foreach (self::$_commissions as $commission) {
                // На текущий день назначена коммиссия.
                if (strtotime($date) >= strtotime($commission->from) && $time <= strtotime($commission->to)) {
                    $commissionIncrease = ($price / 100 * $commission->percent);
                    break;
                }
            }

            foreach (self::$_margin as $margin) {
                // На текущий день назначена маржа.
                if (strtotime($date) >= strtotime($margin->from) && $time <= strtotime($margin->to)) {
                    if ($margin->type == 'number') {
                        $marginIncrease = $margin->value;
                    } else {
                        $marginIncrease = ($price / 100 * $margin->value);
                    }
                    break;
                }
            }

            if (\Yii::$app->session->get('agency')) {
                foreach (self::$_agency as $agency) {
                    // На текущий день назначена $agency.
                    if (strtotime($date) >= strtotime($agency->from) && $time <= strtotime($agency->to)) {
                        if ($agency->type == 'number') {
                            $agencyIncrease = $agency->value;
                        } else {
                            $agencyIncrease = ($price / 100 * $agency->value);
                        }
                        break;
                    }
                }
            }

            foreach (self::$_deals as $deal) {
                if ($deal->type == 'days')
                    continue;

                // На текущий день назначена коммиссия.
                if (strtotime($date) >= strtotime($deal->from) && $time <= strtotime($deal->to)) {
                    $dealsDiscount+= ($price / 100 * $deal->value);
                    break;
                }
            }

            // Общая цена за день.
            $priceOnDay = $price + $commissionIncrease + $marginIncrease + $agencyIncrease - $dealsDiscount;
            // Цена за день без скидок.
            $priceOnDayWithoutDeals = $price + $commissionIncrease + $marginIncrease;

            $result['price']+= $priceOnDay;
            $result['priceWithoutDeals']+= $priceOnDayWithoutDeals;
        }

        foreach (self::$_deals as $deal) {
            if ($deal->type == 'percent')
                continue;

            $countDays = $countDays - 1;
            // Найдено спец предложение по дням.
            if ($deal->minCountDays <= $countDays && $deal->maxCountDays >= $countDays) {
                $priceOnDay = ($result['price'] / $countDays);
                $result['price'] = $priceOnDay * ($countDays - $deal->value);
                break;
            }
        }


        return $result;
    }
}
