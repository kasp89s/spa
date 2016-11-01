<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$hotel = \app\models\Hotel::findOne($_GET['id']);
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= $title?></h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-6">
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
                <?= $hotel->name?>
            </div>
            <?= $form->field($model, 'hotelId')->hiddenInput(['value' => $_GET['id']])->label(false) ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'photos[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

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

            <?= Html::submitButton('Cоздать', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
