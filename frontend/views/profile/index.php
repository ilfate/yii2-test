<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My Profile (' . Yii::$app->user->identity->username . ')';
?>
<div class="site-index">

    <div class="body-content profile">

        <div class="row">
            <div class="col-lg-9">
                <h2>You profile</h2>
                <div class="alert-zone"></div>
                <p data-edit="email" class="edit-container">
                    Your email:
                    <span class="user-data email"><?= $user->email ?></span>
                    <span class="edit-icon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    <span class="save-icon glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                    <span class="remove-icon glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                </p>
                <p data-edit="phone" class="edit-container">
                    Your phone number:
                    <span class="user-data phone"><?= $user->phone ?></span>
                    <span class="edit-icon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    <span class="save-icon glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                    <span class="remove-icon glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                </p>
                <p>
                    In case you want to change you password
                    <?= Html::a('Reset password here', ['site/request-password-reset'], ['class' => 'btn btn-warning']) ?>
                </p>

            </div>
            <div class="col-lg-3">
                <div class="avatar-container">
                    <img src="<?= $avatar ?>" alt="Your avatar" class="avatar img-thumbnail" />
                    <a class="upload-avatar-button btn btn-primary" href="/profile/avatars">Upload avatar</a>
                </div>
                <h2 data-edit="username" class="user-name edit-container">
                    <span class="user-data username"><?= $user->username ?></span>
                    <span class="edit-icon glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    <span class="save-icon glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
                    <span class="remove-icon glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                </h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
        </div>

    </div>
</div>

