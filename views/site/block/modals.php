<?php
   use app\models\Agency;
   use app\models\AgencyLogin;

   $loginForm = new AgencyLogin();
   $registrationForm = new Agency();
?>
<!-- Modal -->
<div class="modal fade" id="agency-login-modal" tabindex="-1" role="dialog" aria-labelledby="agency-login-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Вход для агенств</h4>
            </div>
            <div class="modal-body">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'agency-login-form',
                        'action' => '/site/agency-login',
                        'enableAjaxValidation' => true,
                        'validationUrl' => '/site/agency-login-validate',
                    ]); ?>
                <?= $form->field($loginForm, 'email')->textInput(); ?>
                <?= $form->field($loginForm, 'password')->passwordInput(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Войти</button>
                <button type="button" class="btn btn-primary" data-target="#agency-registration-modal" data-toggle="modal" data-dismiss="modal">Зарегистрироваться</button>
            </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="agency-registration-modal" tabindex="-1" role="dialog" aria-labelledby="agency-registration-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Регистрация для агенств</h4>
            </div>
            <div class="modal-body">
                <p class="bg-success registration-success hidden">
                    Регистрация прошла успешно письмо с подтверждением отправлено Вам на почту.
                </p>

                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'agency-registration-form',
                        'action' => '/site/agency-registration',
                        'enableAjaxValidation' => true,
                        'validationUrl' => '/site/agency-registration-validate',
                    ]); ?>
                <?= $form->field($registrationForm, 'name')->textInput(); ?>
                <?= $form->field($registrationForm, 'companyName')->textInput(); ?>
                <?= $form->field($registrationForm, 'phone')->textInput(); ?>
                <?= $form->field($registrationForm, 'address')->textInput(); ?>
                <?= $form->field($registrationForm, 'email')->textInput(); ?>
                <?= $form->field($registrationForm, 'password')->passwordInput(); ?>
                <?= $form->field($registrationForm, 'password_confirm')->passwordInput(); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Зарегистрироваться</button>
            </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>
