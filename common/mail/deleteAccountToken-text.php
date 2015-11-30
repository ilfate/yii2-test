<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/delete-account', 'token' => $user->delete_account_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to delete your account:

Plz don't do that!

<?= $resetLink ?>
