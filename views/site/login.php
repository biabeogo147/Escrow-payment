<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">Login</h3>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => 'login', 'method' => 'post']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'USERNAME']) ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'PLEASE ENTER YOUR PASSWORD']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['class' => '']) ?>
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <div class="mt-3 text-center">
            <a href="#recoverPassword">Forgot password?</a>
            <br>
            <a href="/site/signup">Don't have an account? Sign up</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>