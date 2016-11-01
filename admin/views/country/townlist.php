<?php
use yii\helpers;
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
                <a href="<?= helpers\Url::toRoute(['town/create']);?>" class="btn btn-success">Создать город</a>
        </div>
        <div class="row"> </div>
        <div class="col-lg-6">
                <? if (!empty($records)):?>
                        <table class="table table-striped" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Страна</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($records as $record):?>
                                <tr>
                                    <td><?= $record->id?></td>
                                    <td><?= $record->name?></td>
                                    <td><?= $record->country->name?></td>
                                    <td>
                                        <a href="<?= helpers\Url::toRoute(['town/hotellist', 'id' => $record->id]);?>" title="список отелей" class="fa fa-list-ul"></a>
                                    </td>
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
<!-- /#page-wrapper -->
