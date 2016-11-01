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

            <div class="form-group field-bookingrequest-name">
                <label class="control-label"><?= $model->attributeLabels()['hotelId']?></label>
                <?= $model->hotel->name?>
            </div>
            <div class="form-group field-bookingrequest-name">
                <label class="control-label"><?= $model->attributeLabels()['roomId']?></label>
                <?= $model->room->name?>
            </div>
            <div class="form-group field-bookingrequest-name">
                <label class="control-label">Дата</label>
                <br />
                <?php $params = json_decode($model->params);?>
                <?= $params->from_d . '.' . $params->from_m . '.' . $params->from_y?> -
                <?= $params->to_d . '.' . $params->to_m . '.' . $params->to_y?>
            </div>
            <div class="form-group field-bookingrequest-name">
                <label class="control-label">Клиенты</label>
                <br />
                <?php
                    $names = json_decode($model->name);
                    $lastName = json_decode($model->lastName);
                    foreach ($names as $key => $name) {
                        echo $name . ' ' . $lastName[$key] . '<br />';
                    }
                ?>
            </div>
            <?//= $form->field($model, 'name') ?>

            <?//= $form->field($model, 'lastName') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'country') ?>

            <?= $form->field($model, 'count') ?>

            <?= $form->field($model, 'pricePerPerson') ?>

            <?= $form->field($model, 'priceTotal') ?>

            <?= $form->field($model, 'status')->dropDownList([
                    'in_progress' => 'В работе',
                    'canceled' => 'Аннулирован',
                    'complete' => 'Забронирован'
                ]);?>
            <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
