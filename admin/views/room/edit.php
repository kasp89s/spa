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
        <div class="col-lg-9">
            <input type="hidden" class="current-id" value="<?= $model->id?>" />
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <!--            <div class="form-group field-hotel-name">
                <label class="control-label" for="hotel-name">Город</label>
                <select name="Hotel[townId]" class="form-control">
                    <?/* foreach ($countries as $country):*/?>
                        <option disabled=""><?/*=$country->name*/?></option>
                        <?/* foreach ($country->towns as $town):*/?>
                            <option value="<?/*= $town->id*/?>">--- <?/*=$town->name*/?></option>
                        <?/* endforeach;*/?>
                    <?/* endforeach;*/?>
                </select>

                <div class="help-block"></div>
            </div>-->

            <div class="form-group field-bookingrequest-name">
                <label class="control-label"><?= $model->attributeLabels()['hotelId']?></label>
                <?= $model->hotel->name?>
            </div>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'photos[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
            <? if (count(json_decode($model->photos)) > 0):?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Загруженые фото
                    </div>
                    <div class="panel-body">
                        <? foreach (json_decode($model->photos) as $photo):?>
                            <div class="col-xs-6 col-md-3">
                                <a href="javascript:void(0)" class="thumbnail">
                                    <img class="remove-photo" data-value="<?= $photo?>" data-href="/admin/room/photo-remove" data-src="holder.js/100%x180" alt="100%x180" src="<?= '/uploads/rooms/' . $model->id . '/' . $photo?>" style="width: 100%; display: block;">
                                </a>
                            </div>
                        <? endforeach;?>
                    </div>
                    <div class="panel-footer">
                        * Кликните на фотографию что бы удалить.
                    </div>
                </div>
            <? endif;?>

            <?= $form->field($model, 'video') ?>

            <?= $form->field($model, 'included')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'liveable') ?>

            <?= $form->field($model, 'viewFrom')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'features')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'title') ?>

            <?= $form->field($model, 'description')->textArea(['rows' => '3']) ?>

            <?= $form->field($model, 'DrInspection') ?>

            <?= $form->field($model, 'procedures') ?>

            <?= $form->field($model, 'drinkingCure')->checkbox(['value' => 1]) ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o fa-fw"></i> Цены на номер
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <button type="button"
                            class="btn btn-outline btn-success"
                            data-toggle="modal" data-target="#myModal"
                        >+ Добавить цену</button>
                    <? if (!empty($model->roomRates)):?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><?= $roomRateModel->attributeLabels()['from']?></th>
                                    <th><?= $roomRateModel->attributeLabels()['to']?></th>
                                    <th><?= $roomRateModel->attributeLabels()['name']?></th>
                                    <th><?= $roomRateModel->attributeLabels()['supplyType']?></th>
                                    <th><?= $roomRateModel->attributeLabels()['quantityType']?></th>
                                    <th><?= $roomRateModel->attributeLabels()['value']?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <? foreach ($model->roomRates as $rate):?>
                                <tr>
                                    <td><?= date('d.m.Y', strtotime($rate->from))?></td>
                                    <td><?= date('d.m.Y', strtotime($rate->to))?></td>
                                    <td><?= $model->name?></td>
                                    <td><?= $rate->supplyType?></td>
                                    <td><?= $rate->quantityType?></td>
                                    <td><?= $rate->value?></td>
                                    <td><a href="<?= helpers\Url::toRoute(['removerate', 'id' => $rate->id]);?>" class="fa fa-times"></a></td>
                                </tr>
                                <? endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <? endif;?>
                </div>
                <!-- /.panel-body -->
            </div>
            <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'rate-form']]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить цену</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content"></div>
                </div>
                <?= $form->field($roomRateModel, 'roomId')->hiddenInput(['value' => $model->id])->label(false) ?>

                <?= $form->field($roomRateModel, 'from')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($roomRateModel, 'to')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($roomRateModel, 'name') ?>
                <table class="table">
                    <tr>
                        <th></th>
                        <th>HBT</th>
                        <th>FBT</th>
                    </tr>
                    <tr>
                        <td>SGL</td>
                        <td><input type="text" name="PRICE_TYPE[HBT_SGL]"></td>
                        <td><input type="text" name="PRICE_TYPE[FBT_SGL]"></td>
                    </tr>
                    <tr>
                        <td>DBL</td>
                        <td><input type="text" name="PRICE_TYPE[HBT_DBL]"></td>
                        <td><input type="text" name="PRICE_TYPE[FBT_DBL]"></td>
                    </tr>
                    <tr>
                        <td>EXB</td>
                        <td><input type="text" name="PRICE_TYPE[HBT_EXB]"></td>
                        <td><input type="text" name="PRICE_TYPE[FBT_EXB]"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary rate-submit">Сохранить</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
