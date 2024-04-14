<?php

/** @var \yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'action' => ['/site/account'],
    'method' => 'post',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>
<div class="form-group">
    <?= $form->field($model, 'fullname')->textInput(['class' => 'form-control']) ?>

    <div class="input-group">
        <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>
        <?php if ($model->email_confirm_date == null): ?>
            <p class="alert alert-warning">Email chưa được xác nhận</p>
            <p class="alert alert-warning">Ấn nút "Cập nhật" để gửi lại email confirm</p>
        <?php endif; ?>
        <?php if ($model->email_confirm_date != null): ?>
            <p class="alert alert-warning">Email đã được xác nhận</p>
        <?php endif; ?>
    </div>

    <?= $form->field($model, 'mobile')->textInput(['class' => 'form-control']) ?>
    <?= $form->field($model, 'address')->textInput(['class' => 'form-control']) ?>
    <?= $form->field($model, 'cccd_number')->textInput(['class' => 'form-control']) ?>
    <?= $form->field($model, 'cccd_issue_date')->textInput(['class' => 'form-control']) ?>
    <?= $form->field($model, 'cccd_issue_name')->textInput(['class' => 'form-control']) ?>
    <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>