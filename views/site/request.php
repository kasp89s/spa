<?php
use app\models\Rooms;
use yii\helpers\Html;

$showBlue = false;
$daysToTravel = date_diff(date_create(date('Y-m-d', time())), date_create($params['dateFrom']))->days;
$photos = !empty($hotel->photos) ? json_decode($hotel->photos) : [];
foreach ($room['price'] as $item) {
    $price = $item;
}
$countTypes = [
    'SGL' => 1,
    'DBL' => 2,
    'EXB' => 3,
];

?>
<div class="search-page">
    <div class="container reserve">
        <div class="col-md-6 request">
            <div class="col-md-12">
                <h3>Ваши данные</h3>
                <h5><?= Rooms::getIncludeTranslate($room['liveable'])?> "<?= $room['name']?>"</h5>
            </div>
            <?= Html::beginForm('', 'post', ['class' => 'request-form']); ?>
            <?= Html::input('hidden', 'BookingRequest[count]', $countTypes[$params['quantityType']])?>

            <?= Html::input('hidden', 'BookingRequest[pricePerPerson]', round(\app\models\RoomRates::getPrice($price['value']) / $countTypes[$params['quantityType']]))?>
            <?= Html::input('hidden', 'BookingRequest[priceTotal]', (int) \app\models\RoomRates::getPrice($price['value']))?>
            <?= Html::input('hidden', 'BookingRequest[params]', json_encode($_GET))?>
                <div class="col-md-12">
                    <?php for ($i = 0; $i < $countTypes[$params['quantityType']]; $i++):?>
                    <div class="col-md-6">
                        <label>Имя</label><br>
                        <?= Html::input('text', 'BookingRequest[name][]', null, [])?>
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                        <label>Фамилия</label><br>
                        <?= Html::input('text', 'BookingRequest[lastName][]', null, [])?>
                        <span class="error"></span>
                    </div>
                    <?php endfor;?>
                    <div class="col-md-6">
                        <span id="name"></span>
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                        <span id="lastName"></span>
                        <span class="error"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <label>Страна</label><br>
                        <?= Html::input('text', 'BookingRequest[country]', null, ['id' => 'country'])?>
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                        <label>Телефон для связи</label><br>
                        <?= Html::input('text', 'BookingRequest[phone]', null, ['id' => 'phone'])?>
                        <span class="error"></span>
                    </div>
                </div>
                <div class="col-md-12 email">
                    <label>Адрес электронной почты</label><br>
                    <?= Html::input('email', 'BookingRequest[email]', null, ['id' => 'email'])?>
                    <span class="error"></span>
                </div>
                <div class="col-md-12 email">
                    <input type="checkbox" name="BookingRequest[approve]" value="1" id="approve">
                    <span>Согласен с <a href="#">условиями бронирования</a> онлайн-портала spamedical</span>
                    <br />
                    <span class="error"></span>
                </div>
                <div class="col-md-12 email">
                    <button type="submit" value="Бронировать">Бронировать</button>
                </div>
                <div class="col-md-12 about">
                    Бронь будет действительна сразу после нажатия на кнопку
                    «Забронировать», дополнительное подтверждение будет
                    отправлено вам на e-mail.
                </div>
            <?= Html::endForm();?>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Ваше бронирование</h3>
                <h5><strong><?= $hotel->name?></strong></h5>
                <div class="fl">
                    <div class="img"><img src="/uploads/hotel/<?= $hotel->id?>/<?= $photos[0]?>" width="220"></div>
                    <div class="about-hotel">
                        <div class="rating">
                            <? if ($hotel->star > 0):?>
                                <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span> ', $hotel->star)?>
                            <? else:?>
                                <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span> ', 3)?>
                            <? endif;?>
                        </div>
                        <div class="hotel">
                            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <?= $hotel->town->name?>, <?= $hotel->town->country->name?>
                            <br><br>
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            <?= $this->params['brecrumbs']['period_from']?> - <?= $this->params['brecrumbs']['period_to']?>
                            (<?= date_diff(date_create($params['dateFrom']), date_create($params['dateTo']))->days?> ночей)
                            <br><br>
                            <span class="glyphicon glyphicon glyphicon-tag" aria-hidden="true"></span>
                            <?php
								$text = mb_substr(strip_tags($hotel->expert), 0, 150, 'UTF-8');
								$text = substr($text, 0, strrpos($text, ' '));
								echo $text;
                    		?>
                        </div>
                    </div>
                </div>
                    <div class="number">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            &nbsp;&nbsp;<?= Rooms::getIncludeTranslate($room['liveable'])?> "<?= $room['name']?>
                        </div>
                        <div class="col-md-3">
                            <? if (!empty($room['photo'])):?>
                                <a href="javascript:void(0)">
                                    <img src="/uploads/rooms/<?= $room['id']?>/<?= $room['photo']?>" />
                                </a>
                            <? endif;?>
                        </div>
                        <div class="col-md-9">
                            <h4>Особенности номера</h4>
                            <?= $room['features']?>
                        </div>
                        <div class="col-md-10">
                            Цена за номер: <span><?= \app\models\RoomRates::getPrice($price['value'])?></span>
                        </div>
                    </div>

                <div class="it">
                    <h3>Итоговая цена:<br>
                        <span><?= \app\models\RoomRates::getPrice($price['value'])?></span></h3>
                    <p>
                        <strong>Цена включает: НДС</strong>
                        <br><br>
                        <strong>Цена не включает: Курортный сбор (1.10 € в день на человека)</strong>
                        <br><br>
                        <strong>Условия аннулирования:</strong><br>

                        <?php if(!empty($hotel->cancelNoPenalty) && $daysToTravel > $hotel->cancelNoPenalty): ?>
                            <?php
                            $daysDiffNoPenalty = $daysToTravel - $hotel->cancelNoPenalty;
                            $noPenaltyDate = date('d.m.Y', strtotime("+$daysDiffNoPenalty day"));
                            $showBlue = true;
                            ?>
                            <strong style="color:#2086b9">до <?= $noPenaltyDate?> бесплатная отмена бронирования</strong><br>
                        <? endif;?>
                        <?php if(!empty($hotel->cancel30Penalty) && $daysToTravel > $hotel->cancel30Penalty && !empty($hotel->cancel100Penalty)):?>
                            <?php
                            $daysDiff30Penalty = $daysToTravel - $hotel->cancel30Penalty;
                            $daysDiff100Penalty = $daysToTravel - $hotel->cancel100Penalty;
                            $Penalty30Date = date('d.m.Y', strtotime("+$daysDiff30Penalty day"));
                            $Penalty100Date = date('d.m.Y', strtotime("+$daysDiff100Penalty day"));
                            ?>
                            <?php if ($showBlue == false):?><strong style="color:#2086b9"><? endif;?>
                            с <?= $Penalty30Date?> до <?= $Penalty100Date?> штрафные санкции <?= \app\models\RoomRates::getPrice(round($price['value'] / 100 * 30))?>
                            <?php if ($showBlue == false):?></strong><? endif;?>
                            <br>
                        <?php $showBlue = true; endif;?>
                        <?php if(!empty($hotel->cancel100Penalty)):?>
                            <?php
                            $daysDiff100Penalty = $daysToTravel - $hotel->cancel100Penalty;
                            $Penalty100Date = date('d.m.Y', strtotime("+$daysDiff100Penalty day"));
                            ?>
                            <?php if ($showBlue == false):?><strong style="color:#2086b9"><? endif;?>
                            с <?= $Penalty100Date?> штрафные санкции <?= \app\models\RoomRates::getPrice($price['value'])?>
                            <?php if ($showBlue == false):?></strong><? endif;?>
                            <br>
                        <?php endif;?>
                </div>
                </p>
            </div>
        </div>
    </div>
</div>
