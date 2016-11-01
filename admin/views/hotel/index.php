<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers;
use app\models\HotelMargin;
use app\models\HotelDeals;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <a href="<?= helpers\Url::toRoute(['create']);?>" class="btn btn-success">Создать отель</a>
        </div>
        <div class="col-lg-9">
            <? if (!empty($records)):?>
                <table class="table table-striped" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Город</th>
                        <th>Фотографий</th>
                        <th>Предложения</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($records as $record):?>
                        <tr>
                            <td><?= $record->id?></td>
                            <td><?= $record->name?></td>
                            <td><?= $record->town->name?></td>
                            <td><?= count(json_decode($record->photos, true))?></td>
                            <td>
                                <? if (!empty($record->margins)):?>
                                    <em>Маржа:</em> <br />
                                    <? foreach ($record->margins as $item):?>
                                        <span class="text-success"><?= date('d.m.Y', strtotime($item->from)) ?></span> -
                                        <span class="text-danger"><?= date('d.m.Y', strtotime($item->to)) ?></span>
                                        <span class="text-info"><?= $item->value ?> <?= ($item->type == 'number') ? 'евро' : '%' ?></span>
                                        <a style="color: #B73333" title="Удалить" href="<?= helpers\Url::toRoute(['marginremove', 'id' => $item->id]);?>" class="fa fa-times"></a>
                                            <br />
                                    <? endforeach;?>
                                <? endif;?>
                                <? if (!empty($record->agency)):?>
                                    <em>Коммисия агенств:</em> <br />
                                    <? foreach ($record->agency as $item):?>
                                        <span class="text-success"><?= date('d.m.Y', strtotime($item->from)) ?></span> -
                                        <span class="text-danger"><?= date('d.m.Y', strtotime($item->to)) ?></span>
                                        <span class="text-info"><?= $item->value ?> <?= ($item->type == 'number') ? 'евро' : '%' ?></span>
                                        <a style="color: #B73333" title="Удалить" href="<?= helpers\Url::toRoute(['agency-remove', 'id' => $item->id]);?>" class="fa fa-times"></a>
                                            <br />
                                    <? endforeach;?>
                                <? endif;?>
                                <? if (!empty($record->commissions)):?>
                                    <em>Коммисии:</em> <br />
                                    <? foreach ($record->commissions as $item):?>
                                        <span class="text-success"><?= date('d.m.Y', strtotime($item->from)) ?></span> -
                                        <span class="text-danger"><?= date('d.m.Y', strtotime($item->to)) ?></span>
                                        <span class="text-info"><?= $item->percent ?> %</span>
                                        <a style="color: #B73333" title="Удалить" href="<?= helpers\Url::toRoute(['commissionremove', 'id' => $item->id]);?>" class="fa fa-times"></a>
                                            <br />
                                    <? endforeach;?>
                                <? endif;?>
                                <? if (!empty($record->deals)):?>
                                    <em>Спецпредложения</em>: <br />
                                    <? foreach ($record->deals as $item):?>
                                        <span class="text-success"><?= date('d.m.Y', strtotime($item->from)) ?></span> -
                                        <span class="text-danger"><?= date('d.m.Y', strtotime($item->to)) ?></span>
                                        <span class="text-muted"><?= $item->name ?></span> - <?= $item->value ?> <?= HotelDeals::getTypes()[$item->type] ?>
                                        <a style="color: #B73333" title="Удалить" href="<?= helpers\Url::toRoute(['dealremove', 'id' => $item->id]);?>" class="fa fa-times"></a>
                                        <br />
                                    <? endforeach;?>
                                <? endif;?>
                            </td>
                            <td>
                                <a href="<?= helpers\Url::toRoute(['roomlist', 'id' => $record->id]);?>" title="список номеров" class="fa fa-list-ul"></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs commission" data-id="<?= $record->id?>" onclick="$('#hotelcommission-hotelid').val($(this).data('id'));" data-toggle="modal" data-target="#commissionModal">Коммисия</button>
                                <button type="button" class="btn btn-primary btn-xs margin" data-id="<?= $record->id?>" onclick="$('#hotelmargin-hotelid').val($(this).data('id'));" data-toggle="modal" data-target="#marginModal">Маржа</button>
                                <button type="button" class="btn btn-primary btn-xs deals" data-id="<?= $record->id?>" onclick="$('#hoteldeals-hotelid').val($(this).data('id'));" data-toggle="modal" data-target="#dealsModal">Спецпредложение</button>
                                <button type="button" class="btn btn-primary btn-xs deals" data-id="<?= $record->id?>" onclick="$('#hotelagency-hotelid').val($(this).data('id'));" data-toggle="modal" data-target="#agencyModal">Коммисия агенств</button>
                                <a title="Добавить" href="<?= helpers\Url::toRoute(['room/create', 'id' => $record->id]);?>" class="fa fa-plus-circle"></a>
                                <a title="Импорт" href="javascript:void(0)" data-id="<?= $record->id?>" data-toggle="modal" onclick="$('#hotelId').val($(this).data('id'));" data-target="#myModal" class="fa fa-file-excel-o"></a>
                                <a title="Редактировать" href="<?= helpers\Url::toRoute(['edit', 'id' => $record->id]);?>" class="fa fa-pencil"></a>
                                <a title="Удалить" href="<?= helpers\Url::toRoute(['remove', 'id' => $record->id]);?>" class="fa fa-times"></a>
                            </td>
                        </tr>
                    <? endforeach;?>
                    </tbody>
                </table>
            <? endif;?>
        </div>
    </div>
    <!-- /.row -->
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin([
                'action' => helpers\Url::toRoute(['import']),
                'options' => ['id' => 'rate-form', 'enctype' => 'multipart/form-data']
            ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Загрузка прайса</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content">
                    </div>
                </div>
                <input type="hidden" id="hotelId" name="hotelId" value="">
                <input type="file" name="excel" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary rate-submit">Загрузить</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="commissionModal" tabindex="-1" role="dialog" aria-labelledby="commissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin([
                'options' => ['id' => 'rate-form']
            ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Коммисия на отель</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content">
                    </div>
                </div>
                <?= $form->field($commission, 'hotelId')->hiddenInput(['value' => ''])->label(false) ?>

                <?= $form->field($commission, 'from')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($commission, 'to')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($commission, 'percent') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Закрыть</button>
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="marginModal" tabindex="-1" role="dialog" aria-labelledby="marginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin([
                'options' => ['id' => 'rate-form']
            ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Маржа на отель</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content">
                    </div>
                </div>
                <?= $form->field($margin, 'hotelId')->hiddenInput(['value' => ''])->label(false) ?>

                <?= $form->field($margin, 'from')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($margin, 'to')->textInput(['class' => 'datepicker']) ?>

				<?= $form->field($margin, 'type')->dropDownList(HotelMargin::getTypes()); ?>

                <?= $form->field($margin, 'value') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Закрыть</button>
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="agencyModal" tabindex="-1" role="dialog" aria-labelledby="agencyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin([
                'options' => ['id' => 'agency-form']
            ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Коммисия агенств на отель</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content">
                    </div>
                </div>
                <?= $form->field($agency, 'hotelId')->hiddenInput(['value' => ''])->label(false) ?>

                <?= $form->field($agency, 'from')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($agency, 'to')->textInput(['class' => 'datepicker']) ?>

				<?= $form->field($agency, 'type')->dropDownList(HotelMargin::getTypes()); ?>

                <?= $form->field($agency, 'value') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Закрыть</button>
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="dealsModal" tabindex="-1" role="dialog" aria-labelledby="dealsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form = ActiveForm::begin([
                'options' => ['id' => 'rate-form']
            ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Спецпредложение на отель</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissable" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="content">
                    </div>
                </div>
                <?= $form->field($deals, 'hotelId')->hiddenInput(['value' => ''])->label(false) ?>

                <?= $form->field($deals, 'from')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($deals, 'to')->textInput(['class' => 'datepicker']) ?>

                <?= $form->field($deals, 'name') ?>

                <?= $form->field($deals, 'type')->dropDownList(HotelDeals::getTypes(), ['class' => 'form-control type-selector']); ?>

                <div class="day-type-fields">
                <?= $form->field($deals, 'minCountDays') ?>

                <?= $form->field($deals, 'maxCountDays') ?>
                </div>
                <?= $form->field($deals, 'value') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Закрыть</button>
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
