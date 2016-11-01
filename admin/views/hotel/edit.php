<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-6">
            <input type="hidden" class="current-id" value="<?= $model->id?>" />
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="form-group field-hotel-name">
                <label class="control-label" for="hotel-name">Город</label>
                <select name="Hotel[townId]" class="form-control">
                    <? foreach ($countries as $country):?>
                        <option disabled=""><?=$country->name?></option>
                        <? foreach ($country->towns as $town):?>
                            <option value="<?= $town->id?>" <? if($town->id == $model->townId) {echo 'selected';}?> >--- <?=$town->name?></option>
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
            <? if (count(json_decode($model->photos)) > 0):?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Загруженые фото
                </div>
                <div class="panel-body">
                    <? foreach (json_decode($model->photos) as $photo):?>
                        <div class="col-xs-6 col-md-3">
                            <a href="javascript:void(0)" class="thumbnail">
                                <img class="remove-photo" data-value="<?= $photo?>" data-href="/admin/hotel/photoremove" data-src="holder.js/100%x180" alt="100%x180" src="<?= '/uploads/hotel/' . $model->id . '/' . $photo?>" style="width: 100%; display: block;">
                            </a>
                        </div>
                    <? endforeach;?>
                </div>
                <div class="panel-footer">
                    * Кликните на фотографию что бы удалить.
                </div>
            </div>
            <? endif;?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Главное лечение
                </div>
                <div class="panel-body">
                        <?php
                            $list = [];
                        if (!empty($model->mainMedications)) {
                            foreach ($model->mainMedications as $medication) {
                                array_push($list, $medication->medicationId);
                            }
                        }
                        ?>
                        <ul>
                            <? foreach (\app\models\Medication::find()->orderBy('id desc')->all() as $medication):?>
                                <li>
                                    <input type="checkbox" name="mainMedication[]" value="<?= $medication->id?>" <?php if(in_array($medication->id, $list)):?>checked=""<?php endif;?>/>
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
                        <?php
                        $list = [];
                        if (!empty($model->secondaryMedications)) {
                            foreach ($model->secondaryMedications as $medication) {
                                array_push($list, $medication->medicationId);
                            }
                        }
                        ?>
                        <ul>
                            <? foreach (\app\models\Medication::find()->orderBy('id desc')->all() as $medication):?>
                                <li>
                                    <input type="checkbox" name="secondaryMedication[]" value="<?= $medication->id?>" <?php if(in_array($medication->id, $list)):?>checked=""<?php endif;?>/>
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
                        <?php
                            $list = [];

                            if (!empty($model->hotelServices)) {
                                foreach ($model->hotelServices as $service) {
                                    $list[$service->serviceId] = $service->description;
                                }
                            }
                        ?>
                        <ul>
                            <? foreach (\app\models\Services::find()->orderBy('id desc')->all() as $service):?>
                                <li>
                                    <input type="checkbox" name="services[<?= $service->id?>][id]" value="<?= $service->id?>" <?php if(isset($list[$service->id])):?>checked=""<?php endif;?>/>
                                    <?= $service->name?>
                                    <img src="/uploads/services/<?= $service->icon?>">
                                    <input type="text" name="services[<?= $service->id?>][description]" value="<?= !empty($list[$service->id]) ? $list[$service->id] : ''?>" placeholder="Описание">
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
                    <?php if (!empty($model->medicalBases)):?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><?= $model->medicalBases[0]->attributeLabels()['title']?></th>
                                    <th><?= $model->medicalBases[0]->attributeLabels()['description']?></th>
                                    <th><?= $model->medicalBases[0]->attributeLabels()['video']?></th>
                                    <th><?= $model->medicalBases[0]->attributeLabels()['image']?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <? foreach ($model->medicalBases as $item):?>
                                    <tr>
                                        <td><?= $item->title?></td>
                                        <td><?= $item->description?></td>
                                        <td><?= $item->video?></td>
                                        <td><img src="/uploads/medicalBase/<?= $model->id?>/<?= $item->image?>" height="50"/></td>
                                        <td><a href="<?= Url::toRoute(['remove-base', 'id' => $item->id]);?>" class="fa fa-times"></a></td>
                                    </tr>
                                <? endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
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

            <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
