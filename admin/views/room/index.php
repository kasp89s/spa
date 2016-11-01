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
                        <th>Назание</th>
                        <th>Страна</th>
                        <th>Город</th>
                        <th>Отель</th>
                        <th>Фотографи</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($records as $record):?>
                        <tr>
                            <td><?= $record->id?></td>
                            <td><?= $record->name?></td>
                            <td><?= $record->hotel->town->country->name?></td>
                            <td><?= $record->hotel->town->name?></td>
                            <td><?= $record->hotel->name?></td>
                            <td><?= count(json_decode($record->photos, true))?></td>
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
