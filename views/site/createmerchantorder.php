<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RequestPayment $model */

$this->title = 'Tạo đơn hàng';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['merchantorder']];
$this->params['breadcrumbs'][] = ['label' => $model->product, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>