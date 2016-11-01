<?php
use yii\helpers;

$model = new \app\models\BookingRequest();
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-9">
            <? if (!empty($records)):?>
                <table class="table table-striped" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?= $model->attributeLabels()['name']?></th>
                        <th><?= $model->attributeLabels()['lastName']?></th>
                        <th><?= $model->attributeLabels()['email']?></th>
                        <th><?= $model->attributeLabels()['phone']?></th>
                        <th><?= $model->attributeLabels()['country']?></th>
                        <th><?= $model->attributeLabels()['hotelId']?></th>
                        <th><?= $model->attributeLabels()['roomId']?></th>
                        <th><?= $model->attributeLabels()['status']?></th>
<!--                        <th>--><?//= $model->attributeLabels()['count']?><!--</th>-->
<!--                        <th>--><?//= $model->attributeLabels()['pricePerPerson']?><!--</th>-->
<!--                        <th>--><?//= $model->attributeLabels()['priceTotal']?><!--</th>-->
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($records as $record):?>
                        <tr>
                            <td><?= $record->id?></td>
                            <td>
                                <?php foreach (json_decode($record->name) as $name):?>
                                    <?= $name;?><br />
                                <?php endforeach;?>
                            </td>
                            <td>
                                <?php foreach (json_decode($record->lastName) as $name):?>
                                    <?= $name;?><br />
                                <?php endforeach;?>
                            </td>
                            <td><?= $record->email?></td>
                            <td><?= $record->phone?></td>
                            <td><?= $record->country?></td>
                            <td><?= $record->hotel->name?></td>
                            <td><?= $record->room->name?></td>
                            <td><?= $record->status?></td>
<!--                            <td>--><?//= $record->count?><!--</td>-->
<!--                            <td>--><?//= $record->pricePerPerson?><!--</td>-->
<!--                            <td>--><?//= $record->priceTotal?><!--</td>-->
                            <td>
                                <a href="<?= helpers\Url::toRoute(['edit', 'id' => $record->id]);?>" class="fa fa-pencil"></a>
                                <a href="<?= helpers\Url::toRoute(['remove', 'id' => $record->id]);?>" class="fa fa-times"></a>
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
