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

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'country') ?>

            <?= $form->field($model, 'text')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'active')->checkbox(['value' => 1]) ?>

            <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
