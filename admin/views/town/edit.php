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
                <? if (!empty($model->photo)):?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Загруженые фото
                        </div>
                        <div class="panel-body">
                                <div class="col-xs-6 col-md-3">
                                    <a href="javascript:void(0)" class="thumbnail">
                                        <img class="remove-photo" data-src="holder.js/100%x180" alt="100%x180" src="<?= '/uploads/town/' . $model->id . '/' . $model->photo?>" style="width: 100%; display: block;">
                                    </a>
                                </div>
                        </div>
                        <div class="panel-footer">
                            * Кликните на фотографию что бы удалить.
                        </div>
                    </div>
                <? endif;?>
            <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
            </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
