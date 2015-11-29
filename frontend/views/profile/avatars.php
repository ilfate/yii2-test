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
                    <img class="avatar-image <?= $avatar->id == $currentAvatar ? 'active' : '' ?>"
                         src="<?= $avatar->url ?>" />
                    <form method="post" action="/profile/delete-avatar">
                        <button type="submit" class="btn btn-warning">Delete</button>

                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                        <input type="hidden" name="avatar_id" value="<?= $avatar->id ?>" />
                    </form>

                    <?php if ($avatar->id !== $currentAvatar) : ?>
                        <a class="btn btn-info">Activate</a>
                    <?php endif; ?>


                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

