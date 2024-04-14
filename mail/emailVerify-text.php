<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verifyemail', 'token' => $user->other_details]);
?>
Hello
<?= $user->username ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>