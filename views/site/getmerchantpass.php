<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Nhập merchant_id và merchant_password tại Ngân Lượng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <div class="row ">

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'merchant_id')->textInput(['class' => 'form-control'])->label('merchant_id') ?>
        <?= $form->field($model, 'merchant_password')->passwordInput(['class' => 'form-control'])->label('merchant_password') ?>

        <div class="form-group">
            <?= Html::submitButton('Tạo yêu cầu chuyển tiền', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>