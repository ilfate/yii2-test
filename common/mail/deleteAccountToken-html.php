<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/delete-account', 'token' => $user->delete_account_token]);
?>
<div class="delete-account">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to delete your account:</p>

    <p>Plz don't do that!</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
