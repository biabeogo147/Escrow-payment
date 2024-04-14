<?php
/**
 * @var app\models\user $model 
 */

use app\models\RequestPayment;

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;

?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'collapse navbar-collapse navbar-nav ms-auto nav-item',
        ]
    ]);
    if (Yii::$app->user->isGuest == false) {
        $menuItems = [
            ['label' => 'Giới thiệu', 'url' => ['/site/gioithieu'],],
            ['label' => 'Dịch vụ', 'url' => ['/site/dichvu'],],
            [
                'label' => 'Đơn hàng bán (' . RequestPayment::find()->andWhere(['merchant' => Yii::$app->user->identity->user_id])->count() . ')',
                'url' => ['/site/merchantorder'],
                'linkOptions' => ['data-method' => 'post',],
            ],
            [
                'label' => 'Đơn hàng mua (' . RequestPayment::find()->andWhere(['customer' => Yii::$app->user->identity->user_id])->count() . ')',
                'url' => ['/site/customerorder'],
                'linkOptions' => ['data-method' => 'post',],
            ],
            [
                'label' => 'Tài khoản',
                'url' => ['/site/account'],
                'linkOptions' => ['data-method' => 'post',],
            ],
            [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post',],
            ],
        ];
    } else {
        $menuItems = [
            ['label' => 'Giới thiệu', 'url' => ['/site/gioithieu'],],
            ['label' => 'Sign Up', 'url' => ['/site/signup'],],
            ['label' => 'Log In', 'url' => ['/site/login'],],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</div>