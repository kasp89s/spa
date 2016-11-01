<?php
use yii\helpers\Html;
?>

<div class="main-menu clearfix">
    <ul class="l-menu">
        <li><?= Html::a('Статистика', '/user/index')?></li>
        <li><?= Html::a('Выплаты', '/user/payments')?></li>
        <li><?= Html::a('Рефералы', '/user/refers')?></li>
        <li><?= Html::a('Поддержка', '/user/support')?></li>
        <li><?= Html::a('FAQ', '/user/faq')?></li>
        <li><?= Html::a('Аккаунт', '/user/account')?></li>
    </ul>
    <ul class="r-menu">
        <li>
            <?= Html::a('<span class="icon ex"></span>', '/user/logout')?>
        </li>
    </ul>
    <span class="line"></span>
</div>