<?php
use yii\helpers;

$path = Yii::getAlias('@webroot') . '/../uploads/slider/';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-9">
            <section>
                <div class="container">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <input type="file" name="photos" id="photos" style="display: none;" multiple>
                    <button type="button" class="btn btn-outline btn-primary upload">Загрузить фото</button>
                    <? if (!empty($records)):?>
                    <ul class="sortable">
                        <? foreach ($records as $record):?>
                        <li id='item-<?= $record->id?>'>
                            <img src="/uploads/slider/<?= $record->image?>" style="width: 300px" alt="">
                            <div style="position: absolute; z-index: 1000; font-weight: bold;"><a href="<?= helpers\Url::toRoute(['remove', 'id' => $record->id]);?>">Удалить</a></div>
                        </li>
                        <? endforeach;?>
                    </ul>
                    <? endif;?>
                </div>
            </section>
        </div>
    </div>
    <!-- /.row -->
</div>
