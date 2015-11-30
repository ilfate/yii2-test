<?php

use yii\helpers\Html;

/**
 * @var string $field
 */
?>


<p data-edit="<?= $field ?>" class="edit-container">
    Your <?= $field ?>:
    <span class="user-data <?= $field ?>"><?= Html::encode($user->$field) ?></span>
    <span class="edit-icon glyphicon glyphicon-pencil" aria-hidden="true"></span>
    <span class="save-icon glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
    <span class="remove-icon glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>

</p>
