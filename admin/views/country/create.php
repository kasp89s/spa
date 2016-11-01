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
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'code') ?>
            <?= $form->field($model, 'name') ?>
            <?= Html::submitButton('Cоздать', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
            </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
