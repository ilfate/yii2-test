<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;

/**
 * Delete account request form
 */
class DeleteAccountRequestForm extends Model
{

    /**
     * Sends an email with a link, for deleting account.
     *
     * @param string $email
     *
     * @return bool whether the email was send
     */
    public function sendEmail($email)
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $email,
        ]);

        if ($user) {
            if (!User::isDeleteAccountTokenValid($user->delete_account_token)) {
                $user->generateDeleteAccountToken();
            }

            if ($user->save()) {
                return \Yii::$app->mailer->compose(['html' => 'deleteAccountToken-html', 'text' => 'deleteAccountToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($email)
                    ->setSubject('Deleting ' . \Yii::$app->name . '`s user account')
                    ->send();
            }
        }

        return false;
    }
}
