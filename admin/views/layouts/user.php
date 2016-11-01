<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title><?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
	<?= Html::csrfMetaTags() ?>
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css"><![endif]-->
    <!--[if lt IE 9]><script type="text/javascript" src="js/pie.js"></script><![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="page">
    <?= $this->render('//user/block/header') ?>

    <?= $this->render('//user/block/menu') ?>
	<?= $content ?>

</div><!-- /page -->
    <?= $this->render('//user/block/footer') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>