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
                        <th>Имя</th>
                        <th>Отзыв</th>
                        <th>Страна</th>
                        <th>Модерация</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($records as $record):?>
                        <tr>
                            <td><?= $record->id?></td>
                            <td><?= $record->name?></td>
                            <td><?= $record->text?></td>
                            <td><?= $record->country?></td>
                            <td><?= $record->active?></td>
                            <td>
                                <a href="<?= helpers\Url::toRoute(['edit', 'id' => $record->id]);?>" class="fa fa-pencil"></a>
                                <a href="<?= helpers\Url::toRoute(['remove', 'id' => $record->id]);?>" class="fa fa-times"></a>
                                <a href="<?= helpers\Url::toRoute(['approve', 'id' => $record->id]);?>" class="fa fa-check"></a>
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
