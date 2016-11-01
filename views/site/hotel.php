<?php
    use yii\helpers\Url;
	use app\models\Rooms;
    use app\models\RoomRates;
?>
        <?php
            $photos = !empty($hotel->photos) ? json_decode($hotel->photos) : [];
            $reviews = !empty($hotel->reviews) ? count($hotel->reviews) : 0;
        ?>
<div class="collapse" id="collapseExample">
    <div class="container">
        <div class="search">
            <div class="top">
                <div class="col-md-6">
                    Поиск санатория
                </div>
                <div class="col-md-6 sales">
                    <a href="<?= Url::to(['shares'])?>">
                        акции и скидки
                    </a>
                </div>
            </div>
            <div class="bottom">
                <form action="<?= Url::to(['search'])?>">
                    <div class="top-s">
                        <div class="col-md-4 input">
                            <label>Куда бы вы хотели отправится?</label><br>
                            <input name="search" placeholder="укажите страну, город или название санатория" value="<?= (!empty($_GET['search'])) ? $_GET['search'] : ''?>">
                        </div>
                        <div class="col-md-4 input">
                            <label>Дата приезда</label><br>
                            <input name="from_d" placeholder="день" class="small" type="number" min="1" max="31" value="<?= (!empty($_GET['from_d'])) ? $_GET['from_d'] : ''?>">
                            <div class="big">
                                <select name="from_m">
                                    <optgroup>
                                        <option value="0">Месяц</option>
                                        <option value="01" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '01') ? 'selected' : ''?>>Январь</option>
                                        <option value="02" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '02') ? 'selected' : ''?>>Февраль</option>
                                        <option value="03" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '03') ? 'selected' : ''?>>Март</option>
                                        <option value="04" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '04') ? 'selected' : ''?>>Апрель</option>
                                        <option value="05" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '05') ? 'selected' : ''?>>Май</option>
                                        <option value="06" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '06') ? 'selected' : ''?>>Июнь</option>
                                        <option value="07" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '07') ? 'selected' : ''?>>Июль</option>
                                        <option value="08" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '08') ? 'selected' : ''?>>Август</option>
                                        <option value="09" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '09') ? 'selected' : ''?>>Сентябрь</option>
                                        <option value="10" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '10') ? 'selected' : ''?>>Октябрь</option>
                                        <option value="11" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '11') ? 'selected' : ''?>>Ноябрь</option>
                                        <option value="12" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '12') ? 'selected' : ''?>>Декабрь</option>
                                    </optgroup>
                                </select>
                            </div>
                            <input name="from_y" class="cal" value="<?= date("Y", time())?>" readonly>
                        </div>
                        <div class="col-md-4 input">
                            <label>Дата отъезда</label><br>
                            <input name="to_d" placeholder="день" class="small" type="number" min="1" max="31" value="<?= (!empty($_GET['to_d'])) ? $_GET['to_d'] : ''?>">
                            <div class="big">
                                <select name="to_m">
                                    <optgroup>
                                        <option value="0">Месяц</option>
                                        <option value="01" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '01') ? 'selected' : ''?>>Январь</option>
                                        <option value="02" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '02') ? 'selected' : ''?>>Февраль</option>
                                        <option value="03" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '03') ? 'selected' : ''?>>Март</option>
                                        <option value="04" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '04') ? 'selected' : ''?>>Апрель</option>
                                        <option value="05" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '05') ? 'selected' : ''?>>Май</option>
                                        <option value="06" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '06') ? 'selected' : ''?>>Июнь</option>
                                        <option value="07" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '07') ? 'selected' : ''?>>Июль</option>
                                        <option value="08" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '08') ? 'selected' : ''?>>Август</option>
                                        <option value="09" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '09') ? 'selected' : ''?>>Сентябрь</option>
                                        <option value="10" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '10') ? 'selected' : ''?>>Октябрь</option>
                                        <option value="11" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '11') ? 'selected' : ''?>>Ноябрь</option>
                                        <option value="12" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '12') ? 'selected' : ''?>>декабрь</option>
                                    </optgroup>
                                </select>
                            </div>
                            <input name="to_y" class="cal" value="<?= date("Y", time())?>" readonly>
                        </div>
                    </div>
                    <div class="bottom-s">
                        <div class="col-md-8 input">
                            <div class="col-md-6">
                                <label>Количество человек</label><br>
                                <div class="big">
                                    <select name="quantityType">
                                        <optgroup>
                                            <option value="SGL" <?= (!empty($_GET['quantityType']) && $_GET['quantityType'] == 'SGL') ? 'selected' : ''?>>Взрослых 1</option>
                                            <option value="DBL" <?= (!empty($_GET['quantityType']) && $_GET['quantityType'] == 'DBL') ? 'selected' : ''?>>Взрослых 2</option>
                                            <option value="EXB" <?= (!empty($_GET['quantityType']) && $_GET['quantityType'] == 'EXB') ? 'selected' : ''?>>Взрослых 3</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Питание и лечение</label><br>
                                <div class="big">
                                    <select name="supplyType">
                                        <optgroup>
                                            <option value="HBT" <?= (!empty($_GET['supplyType']) && $_GET['supplyType'] == 'HBT') ? 'selected' : ''?>>2-х разовое питание с лечением</option>
                                            <option value="FBT" <?= (!empty($_GET['supplyType']) && $_GET['supplyType'] == 'FBT') ? 'selected' : ''?>>3-х разовое питание с лечением</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 input">
                            <button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> &nbsp;&nbsp; Найти
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="search-page">
<div class="search-send">
    <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" data-parent="parent">
        Изменить поиск <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
    </a>
</div>
<div class="container">
<div class="col-md-3">
    <div class="col-md-12 bron">
        <a href="#">Забронировать номер</a>
    </div>
    <div class="col-md-12 prime">
        <div class="head"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> &nbsp;&nbsp;Почему стоит выбирать нас?
        </div>
        <div class="bot">
            <dl>
                <dt>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            <span>
                            Гарантия лучшей цены
                            </span>
                </dt>
                <dd>
                    Понятная экономия&nbsp;•&nbsp;
                    <span class="no_booking_fees_fr_tooltip">Бронирование без комиссии</span>&nbsp;•&nbsp;
                    Регулярные специальные предложения
                </dd>
                <dt>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <span>Наши клиенты доверяют нам</span>
                </dt>
                <dd>
                    На протяжении 20 лет нас выбирают миллионы путешественников со всего мира.
                </dd>
                <dt>
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <span>Просто вносить изменения в бронирование</span>
                </dt>
                <dd>Вы сами управляете своим бронированием. Регистрация не требуется.</dd>
            </dl>
        </div>
    </div>
    <div class="col-md-12 faq">
        <div class="head"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> &nbsp;&nbsp;Часто задаваемые вопросы
        </div>
        <div class="bot">
            <div class="top">
                <strong>Популярные вопросы</strong>
                <a href="#">Включен ли завтрак в цену?
                </a><br>
                <a href="#">Что входит в цену?
                </a>
            </div>
            <div class="bott">
                <strong>Часто задаваемые вопросы</strong>
                <a href="#">Типы номеров
                </a><br>
                <a href="#">Цены
                </a>
                <a href="#">Оплата
                </a><br>
                <a href="#">Порядок проживания и услуги
                </a><br>
                <a href="#">Дополниьтельные услуги
                </a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-9 right-hotel">
<div class="col-md-12">
    <h2><?= $hotel->name?></h2>
	
    <div class="rating">
                <? if ($hotel->star > 0):?>
                    <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span> ', $hotel->star)?>
                <? else:?>
                    <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span> ', 3)?>
                <? endif;?>
    </div>
    <div class="position-right">
        <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;&nbsp;<?= $reviews?> отзывов <span>посмотреть все</span>
        </a>
    </div>
    <div class="address">
        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
        <?= $hotel->town->name?>, <?= $hotel->town->country->name?>, <?= $hotel->address?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-map" style="color: #2086B9; background: url(//cdn2.sanatoriums.com/images/sanatoriums/ico-map-detail.png) left top no-repeat;
    margin-left: 18px;
    text-decoration: none;
    font-size: .85em;
    padding: 2px 0 0 26px;">показать на карте</a>
        </span>
    </div>
</div>
<div class="col-md-12">

    <? if (count($photos) > 0):?>
    <div id="basic" class="svwp">
    	<ul>
        	<? foreach ($photos as $key => $photo):?>
			    <li class="item <? if ($key == 0):?>active<? endif?>">
					<img src="/uploads/hotel/<?= $hotel->id?>/<?= $photo?>" alt="">
				</li>
            <? endforeach;?>
        </ul>
     </div>
	<? endif;?>
    <div class="otziv">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="carousel-caption">
                        <p>близость к источникам, доброжелательное и внимательное отношение персонала и главного врача, прекрасное обслуживание в ресторане и великолепное качество продуктов, живая музыка в ресторане. 
                        </p>
                        <div class="pod">Алиевы, Краснодар</div>
                    </div>
                </div>
                <div class="item">
                    <div class="carousel-caption">
                        <p>Отдых прошел замечательно, лечение тоже, отелем мы полностью довольны, спасибо администрации и персоналу отеля за гостеприимство
                        </p>
                        <div class="pod">Виталий Навальный</div>

                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!--
<div class="col-md-12 set">
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>
    <div class="img">
        <a href="#">
            <img src="/img/hotel-mini.jpg">
        </a>
    </div>

</div>
-->
<div class="col-md-12 about"><?= $hotel->expert ?></div>
<div class="col-md-12 search">
    <div class="po">
        <div class="head">
        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
            Выберите даты пребывания в <?= $hotel->name ?>

        </div>
        <form action="">
            <div class="top-s">
                <div class="col-md-6 input">
                    <label>Дата приезда</label><br>
                    <input name="from_d" placeholder="день" class="small" type="number" min="1" max="31" value="<?= (!empty($_GET['from_d'])) ? $_GET['from_d'] : ''?>">
                    <div class="big">
                            <select name="from_m">
                                <optgroup>
                                    <option value="0">Месяц</option>
                                        <option value="01" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '01') ? 'selected' : ''?>>Январь</option>
                                        <option value="02" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '02') ? 'selected' : ''?>>Февраль</option>
                                        <option value="03" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '03') ? 'selected' : ''?>>Март</option>
                                        <option value="04" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '04') ? 'selected' : ''?>>Апрель</option>
                                        <option value="05" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '05') ? 'selected' : ''?>>Май</option>
                                        <option value="06" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '06') ? 'selected' : ''?>>Июнь</option>
                                        <option value="07" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '07') ? 'selected' : ''?>>Июль</option>
                                        <option value="08" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '08') ? 'selected' : ''?>>Август</option>
                                        <option value="09" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '09') ? 'selected' : ''?>>Сентябрь</option>
                                        <option value="10" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '10') ? 'selected' : ''?>>Октябрь</option>
                                        <option value="11" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '11') ? 'selected' : ''?>>Ноябрь</option>
                                        <option value="12" <?= (!empty($_GET['from_m']) && $_GET['from_m'] == '12') ? 'selected' : ''?>>Декабрь</option>
                                    </optgroup>
                            </select>
                    </div>
                        <input name="from_y" class="cal" value="<?= date("Y", time())?>" readonly>
                </div>
                <div class="col-md-6 input">
                    <label>Дата отъезда</label><br>
                        <input name="to_d" placeholder="день" class="small" type="number" min="1" max="31" value="<?= (!empty($_GET['to_d'])) ? $_GET['to_d'] : ''?>">
                    <div class="big">
                            <select name="to_m">
                                <optgroup>
                                    <option value="0">Месяц</option>
                                        <option value="01" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '01') ? 'selected' : ''?>>Январь</option>
                                        <option value="02" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '02') ? 'selected' : ''?>>Февраль</option>
                                        <option value="03" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '03') ? 'selected' : ''?>>Март</option>
                                        <option value="04" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '04') ? 'selected' : ''?>>Апрель</option>
                                        <option value="05" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '05') ? 'selected' : ''?>>Май</option>
                                        <option value="06" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '06') ? 'selected' : ''?>>Июнь</option>
                                        <option value="07" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '07') ? 'selected' : ''?>>Июль</option>
                                        <option value="08" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '08') ? 'selected' : ''?>>Август</option>
                                        <option value="09" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '09') ? 'selected' : ''?>>Сентябрь</option>
                                        <option value="10" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '10') ? 'selected' : ''?>>Октябрь</option>
                                        <option value="11" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '11') ? 'selected' : ''?>>Ноябрь</option>
                                        <option value="12" <?= (!empty($_GET['to_m']) && $_GET['to_m'] == '12') ? 'selected' : ''?>>декабрь</option>
                                    </optgroup>
                            </select>
                    </div>
                        <input name="to_y" class="cal" value="<?= date("Y", time())?>" readonly>
                </div>
            </div>
            <div class="bottom-s">
                <div class="col-md-10 input">
                    <div class="col-md-6">
                        <label>Количество человек</label><br>
                        <div class="big">
                                <select name="quantityType">
                                    <optgroup>
                                            <option value="SGL" <?= (!empty($_GET['quantityType']) && $_GET['quantityType'] == 'SGL') ? 'selected' : ''?>>Взрослых 1</option>
                                            <option value="DBL" <?= (!empty($_GET['quantityType']) && $_GET['quantityType'] == 'DBL') ? 'selected' : ''?>>Взрослых 2</option>
                                            <option value="EXB" <?= (!empty($_GET['quantityType']) && $_GET['quantityType'] == 'EXB') ? 'selected' : ''?>>Взрослых 3</option>
                                        </optgroup>
                                </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Питание и лечение</label><br>
                        <div class="big">
                                <select name="supplyType">
                                    <optgroup>
                                            <option value="HBT" <?= (!empty($_GET['supplyType']) && $_GET['supplyType'] == 'HBT') ? 'selected' : ''?>>2-х разовое питание с лечением</option>
                                            <option value="FBT" <?= (!empty($_GET['supplyType']) && $_GET['supplyType'] == 'FBT') ? 'selected' : ''?>>3-х разовое питание с лечением</option>
                                        </optgroup>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 input">
                    <button><span class="glyphicon glyphicon-search" aria-hidden="true"></span> &nbsp;&nbsp; Найти
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php if (empty($notFound)):?>
<? if (!empty($period)):?>
<?php
        $rooms = Rooms::getRoomsPrice($hotel->rooms, $params);
        $totalNight = date_diff(date_create($params['dateFrom']), date_create($params['dateTo']))->days;
        ?>
<?php foreach ($rooms as $roomId => $room):?>
<div class="hotel">
    <div class="col-md-12 number">
        <div class="col-md-12">
            <div class="col-md-6">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;&nbsp;<?= Rooms::getIncludeTranslate($room['liveable'])?> "<?= $room['name']?>"
            </div>

            <div class="col-md-6">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#room-description-modal-<?= $room['id']?>">детально о номере <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </a>
<!--                осталось 5 свободных номеров-->
            </div>

        </div>
        <div class="border">
            <div class="col-md-2">
                <? if (!empty($room['photo'])):?>
                    <a href="javascript:void(0)">
                        <img src="/uploads/rooms/<?= $roomId?>/<?= $room['photo']?>" />
                    </a>
                <? endif;?>
            </div>
            <?php foreach ($room['price'] as $price):?>
                <div class="col-md-7">
                    <h4>Цена включает:</h4>
                    <div class="person">
                    	<h5>1-й взрослый</h5>
                        <ul>
                            <li class="bed_std"><span class="glyphicon glyphicon-bed" aria-hidden="true"></span> <span><?= $totalNight?> ночей проживания</span></li>
                            <li class="food"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> <span><?= RoomRates::getSupplyTypeTranslation($price['supplyType'])?></span></li>
                            <?php if (!empty($room['DrInspection'])):?>
                                <li class="exams"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span><?= $room['DrInspection']?>  осмотра доктора</span></li>
                            <?php endif;?>
                            <?php if (!empty($room['procedures'])):?>
                                <li class="procedures"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <span><?= round($room['procedures'] * $totalNight)?> лечебных процедур</span></li>
                            <?php endif;?>
                            <?php if (!empty($room['drinkingCure'])):?>
                                <li class="drinkcure"><span class="glyphicon glyphicon-glass" aria-hidden="true"></span> <span>питьевой курс</span></li>
                            <?php endif;?>
                        </ul>
                        <h5>2-й взрослый</h5>
                        <ul>
                            <li class="bed_std"><span class="glyphicon glyphicon-bed" aria-hidden="true"></span> <span><?= $totalNight?> ночей проживания</span></li>
                            <li class="food"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> <span><?= RoomRates::getSupplyTypeTranslation($price['supplyType'])?></span></li>
                            <?php if (!empty($room['DrInspection'])):?>
                                <li class="exams"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span><span><?= $room['DrInspection']?>  осмотра доктора</span></li>
                            <?php endif;?>
                            <?php if (!empty($room['procedures'])):?>
                                <li class="procedures"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <span><?= round($room['procedures'] * $totalNight)?> лечебных процедур</span></li>
                            <?php endif;?>
                            <?php if (!empty($room['drinkingCure'])):?>
                                <li class="drinkcure"><span class="glyphicon glyphicon-glass" aria-hidden="true"></span> <span>питьевой курс</span></li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            <div class="col-md-3">
                <div class="price-top">
                    Цена за номер<br>
                            <span><?= RoomRates::getQuantityTypeTranslation($price['quantityType'])?></span> <br>
                            <span><?= RoomRates::getSupplyTypeTranslation($price['supplyType'])?></span>
                </div>
                <div class="price-bottom">
                            <? if(round($price['value']) != round($price['totalValue'])):?>
                            <span><?= \app\models\RoomRates::getPrice($price['totalValue'])?></span><br>
                            <? endif;?>
                            <?= \app\models\RoomRates::getPrice($price['value'])?>
                </div>
                <a href="/request?<?= http_build_query(
                    array_merge(
                        $_GET,
                        [
                            'hotel' => $hotel->id,
                            'room' => $room['id']
                        ]
                    )
                )?>">
                    <div class="button">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> БРОНИРОВАТЬ
                    </div>
                </a>
            </div>
       	</div>
		<?php endforeach;?>
    </div>
</div>

            <!-- Modal -->
            <div class="modal fade" id="room-description-modal-<?= $room['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 800px">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel"><?= Rooms::getIncludeTranslate($room['liveable'])?> "<?= $room['name']?>"</h4>
                        </div>
                        <div class="modal-body">
                            Особенности номера: <?= $room['features']?><br />
                            Вид из номера: <?= $room['viewFrom']?><br />
                        </div>
                    </div>
                </div>
            </div>


<? endforeach;?>
<? endif;?>
<? else:?>
    <h3>По запросу нечего не найдено...</h3>
<? endif;?>

<div class="col-md-12 about">
    <h2>О отеле
    </h2>
    <?= $hotel->services ?> <br><br>
</div>

<?php if (!empty($hotel->mainMedications)):?>
<div class="col-md-12 heart">
    <div class="po">
        <div class="head">
            Главные показания к лечению в <?= $hotel->name ?>
        </div>
        <ul>
        <?php foreach ($hotel->mainMedicationsItems as $medication):?>
            <li>
                <img src="/uploads/medication/<?= $medication->icon?>">
                <p><?= $medication->name?></p>
            </li>
        <?php endforeach;?>
        </ul>
    </div>
</div>
<?php endif;?>


<?php if (!empty($hotel->secondaryMedications)):?>
    <div class="col-md-12 heart">
        <div class="po">
            <div class="head">
                Сопутствующие показания к лечению в <?= $hotel->name ?>
            </div>
            <ul>
                <?php foreach ($hotel->secondaryMedicationsItems as $medication):?>
                    <li>
                        <img src="/uploads/medication/<?= $medication->icon?>">
                        <p><?= $medication->name?></p>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
<?php endif;?>

<?php if (!empty($hotel->hotelServices)):?>
    <div class="col-md-12 search">
        <div class="po">
            <div class="head">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Услуги в <?= $hotel->name ?>
            </div>
            <ul>
                <?php foreach ($hotel->hotelServices as $service):?>
                    <li>
                        <img src="/uploads/services/<?= $service->service->icon?>">
                        <strong><?= $service->service->name?></strong><br>
                        (<?= $service->description?>)
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
<?php endif;?>

<?php if (!empty($hotel->medicalBases)):?>
    <div class="col-md-12 search">
        <div class="po">
            <div class="head">
                <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Лечебная база в <?= $hotel->name ?>
            </div>

            <ul style="padding: 0;">
                <?php foreach ($hotel->medicalBases as $base):?>
                    <li class="heart">
                        <img src="/uploads/medicalBase/<?=$hotel->id?>/<?= $base->image?>">
                   		<a href="javascript:void(0)" data-toggle="modal" data-target="#base-modal-<?= $base->id?>"><?= $base->title?></a></em>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>


<?php foreach ($hotel->medicalBases as $base):?>
    <!-- Modal -->
    <div class="modal fade" id="base-modal-<?= $base->id?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 800px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?= $base->title?></h4>
                </div>
                <div class="modal-body">
                    <img src="/uploads/medicalBase/<?=$hotel->id?>/<?= $base->image?>" width="100%">
                    <?php if (!empty($base->video)):?>
                        <a href="javascript:void(0)" data-video-url="<?= $base->video?>" class="play-video" style="display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    text-align: center;
    text-decoration: none;
    font-size: 1.1em;"><em style="background: url(//cdn2.sanatoriums.com/images/sanatoriums/css/gallery/video-play-xl.png) center top no-repeat;
    display: block;
    width: 200px;
    margin: 0 auto;
    height: auto;
    line-height: 276px;
    position: relative;
    top: 40%;
    text-decoration: none;
    color: #FFF;
    font-weight: 700;
    font-style: normal;
    text-shadow: 1px 1px 1px #000;">Посмотреть видео</em></a>
                    <?php endif?>
                    <?= $base->description?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>

<?php endif;?>


<div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= $hotel->name ?></h4>
            </div>
            <div class="modal-body">
                <div id="map" style="width: 780px; height: 600px"></div>
            </div>
        </div>
    </div>
</div>


</div>

</div>
</div>

</div>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    var myMap,
        myPlacemark;

    function init(){
        myMap = new ymaps.Map("map", {
            center: [<?= $hotel->coordinates?>],
            zoom: 15
        });

        myPlacemark = new ymaps.Placemark([<?= $hotel->coordinates?>], {
            hintContent: '<?= $hotel->name?>' +
                <?php if (!empty($photos[0])):?>
                    '<img src="http://<?= $_SERVER['HTTP_HOST']?>/uploads/hotel/<?= $hotel->id?>/<?= $photos[0]?>" />' +
                <?php endif;?>
                '<?= $hotel->address?>',
            iconCaption: '<?= $hotel->name ?>'
        }, {
            preset: "islands#redDotIconWithCaption",
            // Отключаем кнопку закрытия балуна.
            balloonCloseButton: false,
            // Балун будем открывать и закрывать кликом по иконке метки.
            hideIconOnBalloonOpen: false
        });

        myMap.geoObjects.add(myPlacemark);
        <?php foreach ($hotel->town->hotels as $h):?>
        <?php if (empty($h->coordinates) || $h->id == $hotel->id) continue; ?>
        <?php $photos = !empty($hotel->photos) ? json_decode($hotel->photos) : []; ?>
            myMap.geoObjects.add(new ymaps.Placemark([<?= $h->coordinates?>], {
                hintContent: '<?= $h->name?>' +
                    <?php if (!empty($photos[0])):?>
                    '<img src="http://<?= $_SERVER['HTTP_HOST']?>/uploads/hotel/<?= $h->id?>/<?= $photos[0]?>" />' +
                    <?php endif;?>
                    '<?= $h->address?>',
                iconCaption: '<?= $h->name ?>'
            }, {
                preset: "islands#blueDotIconWithCaption",
                // Отключаем кнопку закрытия балуна.
                balloonCloseButton: false,
                // Балун будем открывать и закрывать кликом по иконке метки.
                hideIconOnBalloonOpen: false
            }));
        <?php endforeach;?>
    }
</script>
