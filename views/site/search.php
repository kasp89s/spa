<?php
use yii\helpers\Url;
use app\models\Rooms;
use app\models\RoomRates;
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
<div class="col-md-2">
    Фильтры
</div>
<div class="col-md-10">
<div class="col-md-2">
    Сортировать:
</div>
    <div class="col-md-10">
        <ul class="nav nav-tabs">
            <li role="tabpanel" <? if(empty($_GET['sort']) || (!empty($_GET['sort']) && $_GET['sort'] == 'comment')):?>class="active"<? endif;?>>
                <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'comment']))?>"  ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;&nbsp;отзывам посетителей</a>
            </li>
            <li role="tabpanel" <? if(!empty($_GET['sort']) && $_GET['sort'] == 'request'):?>class="active"<? endif;?>>
                <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'request']))?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> &nbsp;&nbsp;самые продаваемые</a>
            </li>
            <li role="tabpanel" <? if(!empty($_GET['sort']) && $_GET['sort'] == 'top'):?>class="active"<? endif;?>>
                <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'top']))?>" ><span class="glyphicon glyphicon-star" aria-hidden="true"></span> &nbsp;&nbsp;рекомендуемые</a>
            </li>
        </ul>
    </div>
<div class="col-md-12 margin">
    <?php if (empty($notFound)):?>
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="user">
    <div class="col-md-12">
        <? if (!empty($hotels)):?>
            <? foreach ($hotels as $hotel):?>
                <?php
                $photos = !empty($hotel->photos) ? json_decode($hotel->photos) : [];
                $reviews = !empty($hotel->reviews) ? count($hotel->reviews) : 0;
                $params['commissions'] = $hotel->commissions;
                $params['margins'] = $hotel->margins;
                $params['deals'] = $hotel->deals;
                $params['agency'] = $hotel->agency;
                ?>
                <div class="row border">
                    <? if (count($photos) > 0):?>
                        <div class="col-md-3 left">
                            <div class="img">
                                <a href="javascript:void(0)">
                                    <img width="220" class="main-photo" src="/uploads/hotel/<?= $hotel->id?>/<?= $photos[0]?>">
                                </a>
                            </div>
                            <?php unset($photos[0]);?>
                            <? if (count($photos) > 0):?>
                                <? foreach ($photos as $photo):?>
                                    <div class="col-md-4">
                                        <a href="javascript:void(0)">
                                            <img class="photo-<?= $photo?> change-photo-search" src="/uploads/hotel/<?= $hotel->id?>/<?= $photo?>">
                                        </a>
                                    </div>
                                <? endforeach;?>
                            <? endif;?>
                        </div>
                    <? endif;?>
                    <div class="col-md-9 right">
                        <h2><a href="<?= '/hotel/' . $hotel->id?>" style="color: #111"><?= $hotel->name?></a></h2>
                        <div class="rating">
                            <? if ($hotel->star > 0):?>
                                <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span>', $hotel->star)?>
                            <? else:?>
                                <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span>', 3)?>
                            <? endif;?>
                        </div>

                        <div class="position-right">
                            <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp;&nbsp;<?= $reviews?> отзывов</a>
                        </div>
                        <div class="text"><?= $hotel->expert?></div>
                        <? if (!empty($hotel->excellence) && empty($period)):?>
                            <div class="col-md-12 prime">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp;Преимущества отеля
                                    </div>
                                </div>
                                <div class="col-md-12"><?= $hotel->excellence?></div>
                            </div>
                        <? endif;?>
						
						
						
		<? if (!empty($period)):?>
		<?php
            $rooms = Rooms::getRoomsPrice($hotel->rooms, $params, true);
            $totalNight = date_diff(date_create($params['dateFrom']), date_create($params['dateTo']))->days;
            ?>
            </div>
		<?php foreach ($rooms as $roomId => $room):?>
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
                        <a href="<?= '/hotel/' . $hotel->id?>?<?= http_build_query($_GET)?>" style="color: #111;font-size: 15px;font-weight: bold;position: relative;left: 15px;text-decoration: underline;top: 20px;">Посмотреть все</a>
                    </div>
                </div>
            <? endforeach;?>
        <? endif;?>

    </div>
</div>
</div>
<div class="col-md-12">
    <?php
    $currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
    $lastPage = ceil($pages->totalCount / 15);
    ?>
    <nav>
        <ul class="pager">
			<?php 
			 $prev = array_merge($_GET, ['page' => $currentPage - 1]);
			 $next = array_merge($_GET, ['page' => $currentPage + 1]);
			?>
            <li class="previous <? if ($currentPage <= 1):?>disabled<? endif;?>">
                <a href="<? if ($currentPage > 1):?>?<?= http_build_query($prev)?><? else:?>javascript:void(0)<? endif;?>"><span aria-hidden="true">&larr;</span> Предыдущаяя</a>
            </li>

            <li class="next <? if ($currentPage >= $lastPage):?>disabled<? endif;?>">
                <a href="<? if ($currentPage < $lastPage):?>?<?= http_build_query($next)?><? else:?>javascript:void(0)<? endif;?>">Следующая <span aria-hidden="true">&rarr;</span></a>
            </li>
        </ul>
    </nav>
    <br>
</div>
    <? else:?>
        <h3>По запросу нечего не найдено...</h3>
    <?php endif;?>
    <!-- -->
</div>
</div>
</div>
</div>
