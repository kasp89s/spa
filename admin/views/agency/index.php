<?php
use yii\helpers;
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
                        <th><?= $records[0]->attributeLabels()['companyName']?></th>
                        <th><?= $records[0]->attributeLabels()['phone']?></th>
                        <th><?= $records[0]->attributeLabels()['address']?></th>
                        <th><?= $records[0]->attributeLabels()['email']?></th>
                        <th><?= $records[0]->attributeLabels()['active']?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($records as $record):?>
                        <tr>
                            <td><?= $record->id?></td>
                            <td><?= $record->companyName?></td>
                            <td><?= $record->phone?></td>
                            <td><?= $record->address?></td>
                            <td><?= $record->email?></td>
                            <td><?= ($record->active) ? 'да' : 'нет'?></td>
                            <td>
                                <a href="<?= helpers\Url::toRoute(['active', 'id' => $record->id]);?>" class="fa fa-check"></a>
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
