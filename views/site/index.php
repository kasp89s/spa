<?php
    use app\models\RoomRates;
?>
<?= $this->render('//site/block/search'); ?>


<div class="fff">
<div class="container">
<div class="main row">
<div class="title">
<? if (!empty($countries)):?>
<div class="col-md-4">
    <h2>Курортные города:</h2>
</div>
<div class="col-md-8">
    <ul class="nav nav-tabs" >
        <? foreach ($countries as $key => $country):?>
            <li role="presentation" <? if ((empty($_GET['country']) && $key == 0) || (!empty($_GET['country']) && $country->id == $_GET['country'])):?>class="active"<?endif;?>>
                <a href="?<?= http_build_query(array_merge($_GET, ['country' => $country->id]))?>"><?= $country->code?> &nbsp;&nbsp;<?= $country->name?></a>
            </li>
        <? endforeach;?>
    </ul>
</div>
<? endif;?>
<? if (!empty($countries)):?>
<div class="col-md-12">
<!-- Tab panes -->
<div class="tab-content">
<!--    --><?// foreach ($countries as $key => $country):?>
    <div role="tabpanel" class="tab-pane active" id="c<?= $country->id?>">
        <? foreach ($currentCountry->towns as $town):?>
        <div class="col-md-3">
            <img src="<?= '/uploads/town/' . $town->id . '/' . $town->photo?>">
            <div class="title">
                <?= $town->name?><br>
                <a href="<?= '/list/' . $town->id?>">смотреть <?= \app\models\Town::getTypes()[$town->type]?></a>
            </div>
        </div>
        <? endforeach;?>
    </div>
<!--    --><?// endforeach;?>
</div>
</div>
<? endif;?>
</div>

<div class="title">
<div class="col-md-4">
    <h2 name="top">Лучшие отели по:</h2>
</div>
<div class="col-md-8">
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
<div class="col-md-12">
<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="user">
    <? foreach ($hotels as $hotel):?>
        <div class="col-md-3">
            <div class="top-h">
                <?php
                    $photos = json_decode($hotel->photos);
                    $photo = isset($photos[0]) ? $photos[0] : '';
                    $reviews = !empty($hotel->reviews) ? count($hotel->reviews) : 0;
                    $rooms = $hotel->rooms;
                    $rates = [];
                    foreach ($hotel->rooms as $room) {
                        foreach ($room->roomRates as $rate) {
                            if (strtotime($rate->from) < time() && strtotime($rate->to) > time()) {
                                $rates[(int) $rate->value] = $rate;
                            }
                        }
                    }
                    krsort($rates);
                    $rate = end($rates);
                ?>
                <img src="<?= '/uploads/hotel/' . $hotel->id . '/' . $photo?>">
                <div class="title">
                    <a href="<?= '/hotel/' . $hotel->id?>"><?= $hotel->name?></a>
                </div>
                <? if ($hotel->star > 0):?>
                    <div class="rating">
                        <?= str_repeat('<span class="glyphicon glyphicon-star" aria-hidden="true"></span>', $hotel->star)?>
                    </div>
                <? endif;?>
            </div>
            <div class="bottom">
                <div class="text">
                    <?php
                        $text = mb_substr(strip_tags($hotel->expert), 0, 150, 'UTF-8');
                        $text = substr($text, 0, strrpos($text, ' '));
                        echo $text;
                    ?>
                </div>
                <? if(!empty($rate)):?>
                <div class="price">
                    <span>От <?= \app\models\RoomRates::getPrice($rate->value)?> за 1 ночь</span><br>
                    <?= RoomRates::getSupplyTypeTranslation($rate->supplyType)?>
                </div>
                <? endif;?>
                <div class="button">
                    <img src="/img/button.jpg"/>
                    <a href="<?= '/hotel/' . $hotel->id?>" class="left">
                        ПОДРОБНЕЕ
                    </a>
                    <a href="#" class="right">
                        <?= $reviews?> отзывов
                    </a>
                </div>
            </div>
        </div>
    <? endforeach;?>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
