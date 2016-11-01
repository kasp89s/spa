<?php
    use yii\helpers;
?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/admin">«SPA MEDICAL TRAVEL»</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <a href="<?= helpers\Url::to(['/settings/index']);?>"><i class="fa fa-gear fa-fw"></i> Настройки</a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="<?= helpers\Url::toRoute(['logout']);?>"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= helpers\Url::toRoute(['country/index']);?>"><i class="fa fa-fw"></i> Страны</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['town/index']);?>"><i class="fa fa-fw"></i> Города</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['hotel/index']);?>"><i class="fa fa-fw"></i> Отели</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['room/index']);?>"><i class="fa fa-fw"></i> Номера</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['comment/index']);?>"><i class="fa fa-fw"></i> Отзывы к отелям</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['page/index']);?>"><i class="fa fa-fw"></i> Статические страницы</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['slider/index']);?>"><i class="fa fa-fw"></i> Слайдер</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['order/index']);?>"><i class="fa fa-fw"></i> Заявки бронирования</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['agency/index']);?>"><i class="fa fa-fw"></i> Агенства</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['medication/index']);?>"><i class="fa fa-fw"></i> Лечение</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['services/index']);?>"><i class="fa fa-fw"></i> Услуги</a>
            </li>
            <li>
                <a href="<?= helpers\Url::toRoute(['includes/index']);?>"><i class="fa fa-fw"></i> Что включает номер</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
