<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
            <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($model, 'countryId')->dropDownList(
                yii\helpers\ArrayHelper::map($countries, 'id', 'name')
            ); ?>
            <?= $form->field($model, 'type')->dropDownList(\app\models\Town::getTypes()); ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'photo')->fileInput(['accept' => 'image/*']) ?>
            <?= Html::submitButton('Cоздать', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
            </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
