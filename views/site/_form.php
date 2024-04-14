<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RequestPayment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'action' => ['/site/createmerchantorder'],
        'options' => ['enctype' => 'multipart/form-data'],
        'method' => 'post',
    ]); ?>

    <div class="row">
        <div class="col-sm-8">

            <?= $form->field($model, 'merchantName')->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true])->label(true); ?>

            <?= $form->field($model, 'customer')->textInput(['maxlength' => true])->label('Customer ID') ?>

            <?= $form->field($model, 'product')->textInput() ?>

            <?= $form->field($model, 'price')->textInput() ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>