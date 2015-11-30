<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'My avatars';
?>
<div class="site-index">

    <div class="body-content avatars">

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'dropzone']]) ?>

                <div class="dz-default dz-message"><span>Drop files here to upload</span></div>

                <?php \yii\widgets\ActiveForm::end() ?>

                <div class="alert-zone"></div>


            </div>
        </div>
        <div class="row avatars-row">
            <?php foreach($avatars as $avatar): ?>
                <div class="col-lg-2">
                    <div class="image-container <?= $avatar->id == $currentAvatar ? 'active' : '' ?>">
                        <form class="delete-form" method="post" action="/profile/delete-avatar">
                            <button type="submit" class="btn btn-warning">Delete</button>

                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                            <input type="hidden" name="avatar_id" value="<?= $avatar->id ?>" />
                        </form>

                        <?php if ($avatar->id !== $currentAvatar) : ?>
                            <form class="activate-form" method="post" action="/profile/activate-avatar">
                                <button type="submit" class="btn btn-info">Activate</button>

                                <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                <input type="hidden" name="avatar_id" value="<?= $avatar->id ?>" />
                            </form>
                        <?php endif; ?>
                        <img class="avatar-image"
                             src="<?= $avatar->url ?>" />
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

