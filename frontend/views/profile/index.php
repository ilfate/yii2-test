<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Profile (' . Html::encode(Yii::$app->user->identity->username) . ')';
?>
<div class="site-index">

    <div class="body-content profile">

        <div class="row">
            <div class="col-lg-9">
                <h2>You profile</h2>
                <div class="alert-zone"></div>
                <?php $fields = ['email', 'phone']; ?>
                <?php foreach ($fields as $field): ?>
                    <?= $this->render('partials/editable-field', ['field' => $field, 'user' => $user]); ?>
                <?php endforeach; ?>
                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                <p>
                    In case you want to change you password
                    <?= Html::a('Reset password here', ['site/request-password-reset'], ['class' => 'btn btn-warning']) ?>
                </p>
                <p>
                    If you want to delete your account
                    <?= Html::a('Delete my account', ['site/request-delete-account'], ['class' => 'btn btn-danger']) ?>
                </p>

            </div>
            <div class="col-lg-3">
                <div class="avatar-container">
                    <img src="<?= $avatar ?>" alt="Your avatar" class="avatar img-thumbnail" />
                    <a class="upload-avatar-button btn btn-primary" href="/profile/avatars">Upload avatar</a>
                </div>
                <h2 data-edit="username" class="user-name edit-container">
                    <span class="user-data username"><?= Html::encode($user->username) ?></span>
                    <span class="edit-icon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    <span class="save-icon glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                    <span class="remove-icon glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                </h2>
            </div>
        </div>

    </div>
</div>

