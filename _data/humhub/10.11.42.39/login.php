<?php

use yii\captcha\Captcha;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use humhub\modules\user\widgets\AuthChoice;

$this->pageTitle = Yii::t('UserModule.views_auth_login', 'Login');
?>

<div class="container" style="text-align: center;">
    <?= humhub\widgets\SiteLogo::widget(['place' => 'login']); ?>
    <br>

    <div class="panel panel-default animated bounceIn" id="login-form"
         style="max-width: 300px; margin: 0 auto 20px; text-align: left;">

        <div class="panel-heading"><?= Yii::t('UserModule.views_auth_login', '<strong>Please</strong> sign in'); ?></div>

        <div class="panel-body">

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <?php if (AuthChoice::hasClients()): ?>
                <?= AuthChoice::widget([]) ?>
            <?php else: ?>
                <?php if ($canRegister) : ?>
                    <p><?= Yii::t('UserModule.views_auth_login', "If you're already a member, please login with your username/email and password."); ?></p>
                <?php else: ?>
                    <p><?= Yii::t('UserModule.views_auth_login', "Please login with your username/email and password."); ?></p>
                <?php endif; ?>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(['id' => 'account-login-form', 'enableClientValidation' => false]); ?>
            <?= $form->field($model, 'username')->textInput(['id' => 'login_username', 'placeholder' => $model->getAttributeLabel('username'), 'aria-label' => $model->getAttributeLabel('username')])->label(false); ?>
            <?= $form->field($model, 'password')->passwordInput(['id' => 'login_password', 'placeholder' => $model->getAttributeLabel('password'), 'aria-label' => $model->getAttributeLabel('password')])->label(false); ?>
            <?= $form->field($model, 'rememberMe')->checkbox(); ?>

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <?= CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Sign in'), ['id' => 'login-button', 'data-ui-loader' => "", 'class' => 'btn btn-large btn-primary']); ?>
                </div>
                <div class="col-md-8 text-right">
                <small>
                        <a  href="http://10.11.42.39:8099/account/register" target="_new"><br><?= Yii::t('UserModule.views_auth_login', 'Register') ?></a>
                    </small>
                    <small>
                        <a href="http://10.11.42.39:8099/account/reset/request>" target="_new"><br><?= Yii::t('UserModule.views_auth_login', 'Forgot your password?') ?></a>
                    </small>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

    <br>

    <?php if ($canRegister) : ?>
        <div id="register-form"
             class="panel panel-default animated bounceInLeft"
             style="max-width: 300px; margin: 0 auto 20px; text-align: left;">

            <div class="panel-heading"><?= Yii::t('UserModule.views_auth_login', '<strong>Sign</strong> up') ?></div>

            <div class="panel-body">

                <p><?= Yii::t('UserModule.views_auth_login', "Don't have an account? Join the network by entering your e-mail address."); ?></p>

                <?php $form = ActiveForm::begin(['id' => 'invite-form']); ?>
                <?= $form->field($invite, 'email')->input('email', ['id' => 'register-email', 'placeholder' => $invite->getAttributeLabel('email'), 'aria-label' => $invite->getAttributeLabel('email')])->label(false); ?>
                <?php if ($invite->showCaptureInRegisterForm()) : ?>
                    <div id="registration-form-captcha" style="display: none;">
                        <div><?= Yii::t('UserModule.views_auth_login', 'Please enter the letters from the image.'); ?></div>

                        <?= $form->field($invite, 'captcha')->widget(Captcha::class, [
                            'captchaAction' => 'auth/captcha',
                        ])->label(false);?>
                    </div>
                <?php endif; ?>
                <hr>
                <?= CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Register'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']); ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>

    <?= humhub\widgets\LanguageChooser::widget(); ?>
</div>

<script type="text/javascript">
    $(function () {
        // set cursor to login field
        $('#login_username').focus();
    });

    // Shake panel after wrong validation
<?php if ($model->hasErrors()) { ?>
        $('#login-form').removeClass('bounceIn');
        $('#login-form').addClass('shake');
        $('#register-form').removeClass('bounceInLeft');
        $('#app-title').removeClass('fadeIn');
<?php } ?>

    // Shake panel after wrong validation
<?php if ($invite->hasErrors()) { ?>
        $('#register-form').removeClass('bounceInLeft');
        $('#register-form').addClass('shake');
        $('#login-form').removeClass('bounceIn');
        $('#app-title').removeClass('fadeIn');
<?php } ?>

<?php if ($invite->showCaptureInRegisterForm()) { ?>
    $('#register-email').on('focus', function () {
        $('#registration-form-captcha').fadeIn(500);
    });
<?php } ?>

</script>


