<?php

use app\models\RequestPayment;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'DANH SÁCH ĐƠN HÀNG (MUA)';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index" style="text-align:center;">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <?= $this->render('_order', [
        'dataProvider' => $dataProvider,
    ]) ?>

</div>