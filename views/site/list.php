<?php
use app\models\Rooms;

?>
<div class="search-page">
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
<div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="user">
<div class="col-md-12">

<? if (!empty($hotels)):?>
    <? foreach ($hotels as $hotel):?>
        <?php
            $photos = !empty($hotel->photos) ? json_decode($hotel->photos) : [];
            $reviews = !empty($hotel->reviews) ? count($hotel->reviews) : 0;
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
        <? if (!empty($hotel->deals)):?>
            <div class="col-md-12 prime">
                <div class="col-md-12">
                    <div class="col-md-6">
                        Предложения и скидки
                    </div>
                </div>
                <div class="col-md-12">
                    <? foreach ($hotel->deals as $deal):?>
                        <?php if($deal->type == 'days') continue;?>
                        
                        <?= $deal->name?> скидка - <?= $deal->value?>% <br />
                    <? endforeach;?>
                </div>
            </div>
        <? endif;?>
        <? if (!empty($hotel->excellence)):?>
        <div class="col-md-12 prime">
            <div class="col-md-12">
                <div class="col-md-6">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> &nbsp;&nbsp;Преимущества отеля
                </div>
            </div>
            <div class="col-md-12"><?= $hotel->excellence?></div>
        </div>
        <? endif;?>
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
        $lastPage = floor($pages->totalCount / 10);
    ?>
    <nav>
        <ul class="pager">
            <li class="previous <? if ($currentPage <= 1):?>disabled<? endif;?>">
                <a href="<? if ($currentPage > 1):?>?page=<?= $currentPage - 1?><? else:?>javascript:void(0)<? endif;?>"><span aria-hidden="true">&larr;</span> Предыдущаяя</a>
            </li>

            <li class="next <? if ($currentPage >= $lastPage):?>disabled<? endif;?>">
                <a href="<? if ($currentPage < $lastPage):?>?page=<?= $currentPage + 1?><? else:?>javascript:void(0)<? endif;?>">Следующая <span aria-hidden="true">&rarr;</span></a>
            </li>
        </ul>
    </nav>
    <br>
</div>
</div>
</div>
</div>
</div>
