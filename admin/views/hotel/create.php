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
            <div class="form-group field-hotel-name">
                <label class="control-label" for="hotel-name">Город</label>
                <select name="Hotel[townId]" class="form-control">
                    <? foreach ($countries as $country):?>
                        <option disabled=""><?=$country->name?></option>
                        <? foreach ($country->towns as $town):?>
                            <option value="<?= $town->id?>">--- <?=$town->name?></option>
                        <? endforeach;?>
                    <? endforeach;?>
                </select>

                <div class="help-block"></div>
            </div>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'address') ?>

            <?= $form->field($model, 'coordinates') ?>

            <?= $form->field($model, 'video') ?>

            <?= $form->field($model, 'photos[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Главное лечение
                </div>
                <div class="panel-body">
                    <ul>
                        <? foreach (\app\models\Medication::find()->orderBy('id desc')->all() as $medication):?>
                            <li>
                                <input type="checkbox" name="mainMedication[]" value="<?= $medication->id?>"/>
                                <?= $medication->name?>
                                <img src="/uploads/medication/<?= $medication->icon?>">
                            </li>
                        <? endforeach;?>
                    </ul>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Второстепенное лечение
                </div>
                <div class="panel-body">
                    <ul>
                        <? foreach (\app\models\Medication::find()->orderBy('id desc')->all() as $medication):?>
                            <li>
                                <input type="checkbox" name="secondaryMedication[]" value="<?= $medication->id?>" />
                                <?= $medication->name?>
                                <img src="/uploads/medication/<?= $medication->icon?>">
                            </li>
                        <? endforeach;?>
                    </ul>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Услуги
                </div>
                <div class="panel-body">
                    <ul>
                        <? foreach (\app\models\Services::find()->orderBy('id desc')->all() as $service):?>
                            <li>
                                <input type="checkbox" name="services[<?= $service->id?>][id]" value="<?= $service->id?>"/>
                                <?= $service->name?>
                                <img src="/uploads/services/<?= $service->icon?>">
                                <input type="text" name="services[<?= $service->id?>][description]" value="" placeholder="Описание">
                            </li>
                        <? endforeach;?>
                    </ul>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Лечебная база
                </div>
                <div class="panel-body">
                    <button type="button" class="btn btn-outline btn-success add-base" data-count="1">+ Добавить позицию</button>
                </div>
            </div>
            <?= $form->field($model, 'expert')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'excellence')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'termsOfPayment')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'services')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'mainReadings')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'secondaryReadings')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'sorting') ?>

            <?= $form->field($model, 'cancelNoPenalty') ?>

            <?= $form->field($model, 'cancel30Penalty') ?>

            <?= $form->field($model, 'cancel100Penalty') ?>

            <?= $form->field($model, 'star') ?>

            <?= $form->field($model, 'top')->checkbox(['value' => 1]) ?>

            <?= Html::submitButton('Cоздать', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
