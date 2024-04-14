<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\User;

/** @var yii\web\View $this */
/** @var app\models\Requestpayment $model */

$this->title = $model->product;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1 class="mb-3" style="text-align:center;">
        <?= Html::encode($this->title) ?>
    </h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'merchant',
                'value' => function ($model) {
                        $merchant = User::findOne($model->merchant);
                        return $merchant->username;
                    }
            ],
            [
                'attribute' => 'customer',
                'value' => function ($model) {
                        $customer = User::findOne($model->customer);
                        return $customer->username;
                    }
            ],
            'product',
            'price',
            [
                'attribute' => 'created_time',
                'value' => function ($model) {
                        return $model->visualDate($model->created_time);
                    },
            ],
            [
                'attribute' => 'accept_request',
                'format' => 'raw',
                'value' => function ($model) {
                        if ($model->accept_request == null && $model->customer == Yii::$app->user->identity->user_id) {
                            return Html::a('Accept Request', ['/site/acceptrequest', 'id' => $model->id], ['class' => 'btn btn-success']);
                        } else {
                            if ($model->accept_request == null)
                                return 'Người mua chưa chấp nhận đơn hàng';
                            else
                                return 'Đã chấp nhận đơn hàng vào lúc ' . $model->visualDate($model->accept_request);
                        }
                    },
            ],
            [
                'attribute' => 'paid_status',
                'format' => 'raw',
                'value' => function ($model) {
                        if ($model->accept_request == null)
                            return null;
                        if ($model->paid_status == null && $model->customer == Yii::$app->user->identity->user_id) {
                            return Html::a('Chuyển tiền cho bên trung gian', ['/site/payforintermediaries', 'id' => $model->id], ['class' => 'btn btn-success']);
                        } else {
                            if ($model->paid_status == null)
                                return 'Người mua chưa chuyển tiền cho bên trung gian';
                            else
                                return Html::a('Đã chuyển tiền', ['/site/viewpayment', 'id' => $model->id], ['class' => 'btn btn-success']);
                        }
                    },
            ],
            [
                'attribute' => 'product_delivery',
                'format' => 'raw',
                'value' => function ($model) {
                        if ($model->paid_status == null)
                            return null;
                        if ($model->product_delivery == null && $model->merchant == Yii::$app->user->identity->user_id) {
                            return Html::a('Xác nhận đã giao hàng', ['/site/productdelivery', 'id' => $model->id], ['class' => 'btn btn-success']);
                        } else {
                            if ($model->product_delivery == null)
                                return 'Người bán chưa giao hàng';
                            else
                                return 'Đã giao hàng vào lúc ' . $model->visualDate($model->product_delivery);
                        }
                    },
            ],
            [
                'attribute' => 'accept_product',
                'format' => 'raw',
                'value' => function ($model) {
                        if ($model->product_delivery == null)
                            return null;
                        if ($model->accept_product == null && $model->customer == Yii::$app->user->identity->user_id) {
                            return Html::a('Xác nhận đã kiểm định xong đơn hàng', ['/site/acceptproduct', 'id' => $model->id], ['class' => 'btn btn-success']);
                        } else {
                            if ($model->accept_product == null)
                                return 'Người mua chưa kiểm định xong sản phẩm';
                            else
                                return 'Đã kiểm định xong lúc ' . $model->visualDate($model->accept_product);
                        }
                    },
            ],
            [
                'attribute' => 'complete_order',
                'value' => function ($model) {
                        return $model->visualDate($model->complete_order);
                    },
            ],
        ],
    ]) ?>
</div>