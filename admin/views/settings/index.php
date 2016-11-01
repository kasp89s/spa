<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'course') ?>
            <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
