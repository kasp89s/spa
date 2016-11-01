<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="ru" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="ru" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="<?= Yii::$app->language ?>">
<!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('//site/static/header'); ?>

<?= $content ?>

<?= $this->render('//site/static/footer'); ?>

<?= $this->render('//site/block/modals'); ?>

<?php $this->endBody() ?>
	<script type="text/javascript">
		$(window).bind("load", function() {
			$("div#basic").slideViewerPro({
				thumbs: 50, 
				autoslide: true, 
				asTimer: 3500, 
				typo: true,
				galBorderWidth: 0,
				thumbsBorderOpacity: 0, 
				buttonsTextColor: "#707070",
				buttonsWidth: 20,
				thumbsActiveBorderOpacity: 0.1,
				thumbsRightMargin: 5,
				thumbsTopMargin: 3,  
				thumbsActiveBorderColor: "white",
				shuffle: true
			});
		});
	</script>
	<script src="/web/js/slide-hotel.js"></script>
</body>
</html>
<?php $this->endPage() ?>
