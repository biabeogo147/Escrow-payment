<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verifyemail', 'token' => $user->other_details]);
?>
<div class="VerifyEmail">
    <p>Hello
        <?= Html::encode($user->username) ?>,
    </p>

    <p>Follow the link below to verify your email:</p>

    <p>
        <?= Html::a(Html::encode($verifyLink), $verifyLink) ?>
    </p>
</div>