<?php

use app\models\RequestPayment;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        /*[
            'attribute' => 'product_image',
            'content' => function ($model) {
                    return $this->render('_product_item', ['model' => $model]);
                },
            'contentOptions' => ['style' => 'width:15%;'],
        ],*/
        [
            'attribute' => 'merchant',
            'content' => function ($model) {
                $merchant = User::findOne($model->merchant);
                return $merchant->username;
            }
        ],
        'product',
        [
            'attribute' => 'price',
            'content' => function ($model) {
                return $model->visualProductPrice();
            }
        ],
        [
            'attribute' => 'created_time',
            'content' => function ($model) {
                return $model->visualDate($model->created_time);
            }
        ],
        [
            'attribute' => 'accept_request',
            'content' => function ($model) {
                return $model->visualDate($model->accept_request);
            }
        ],
        [
            'attribute' => 'paid_status',
            'content' => function ($model) {
                if ($model->paid_status == null) {
                    return 'Người mua chưa chuyển tiền';
                } else {
                    return 'Người mua đã chuyển tiền';
                };
            }
        ],
        [
            'attribute' => 'product_delivery',
            'content' => function ($model) {
                return $model->visualDate($model->product_delivery);
            }
        ],
        [
            'attribute' => 'accept_product',
            'content' => function ($model) {
                return $model->visualDate($model->accept_product);
            }
        ],
        [
            'attribute' => 'complete_order',
            'content' => function ($model) {
                return $model->visualDate($model->complete_order);
            }
        ],
        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, RequestPayment $model, $key, $index, $column) {
                return Url::toRoute(['/site/vieworder', 'id' => $model->id]);
            }
        ],
    ],
]); ?>