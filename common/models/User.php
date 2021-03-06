<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $delete_account_token
 * @property string $email
 * @property string $auth_key
 * @property string $phone
 * @property integer $avatar_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const PHONE_MIN_LENGTH = 8;
    const PHONE_MAX_LENGTH = 20;

    const USERNAME_MIN_LENGTH = 3;
    const USERNAME_MAX_LENGTH = 20;

    protected static $editableFields = [
        'email',
        'phone',
        'username'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['phone', 'string', 'length' => [self::PHONE_MIN_LENGTH, self::PHONE_MAX_LENGTH]],
            ['username', 'string', 'length' => [self::USERNAME_MIN_LENGTH, self::USERNAME_MAX_LENGTH]],
            ['username', 'match', 'pattern'=> '/^[A-Za-z0-9_]+$/u',
                                  'message'=> 'Username should not contain special characters.'],
            ['avatar_id', 'exist', 'targetClass' => 'common\models\Avatar', 'targetAttribute' => 'id'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by delete account token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByDeleteAccountToken($token)
    {
        if (!static::isDeleteAccountTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'delete_account_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        return self::isTokenValid($token, 'password');
    }

    /**
     * Finds out if delete account reset token is valid
     *
     * @param string $token delete account token
     * @return boolean
     */
    public static function isDeleteAccountTokenValid($token)
    {
        return self::isTokenValid($token, 'deleteAccount');
    }

    /**
     * @param $token
     * @param $type
     *
     * @return bool
     */
    protected static function isTokenValid($token, $type)
    {
        if (empty($token)) {
            return false;
        }
        switch ($type)
        {
            case 'deleteAccount':
                $expire = Yii::$app->params['user.deleteAccountTokenExpire'];
                break;
            default:
            case 'password':
                $expire = Yii::$app->params['user.passwordResetTokenExpire'];
                break;
        }
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new password reset token
     */
    public function generateDeleteAccountToken()
    {
        $this->delete_account_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Removes password reset token
     */
    public function removeDeleteAccountToken()
    {
        $this->delete_account_token = null;
    }

    /**
     * Relation to avatar
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return $this->hasOne(Avatar::className(), ['id' => 'avatar_id']);
    }

    public function getUploadedAvatars()
    {
        return $this->hasMany(Avatar::className(), ['creator_id' => 'id']);
    }

    /**
     * @param $type
     * @param $value
     *
     * @return bool
     * @throws \Exception
     */
    public function updateField($type, $value)
    {
        if (!in_array($type, self::$editableFields)) {
            throw new \Exception('wrong field type', 404);
        }
        $this->{$type} = strip_tags($value);
        $result = $this->save();
        if (!$result) {
            $message = '';
            $errors = $this->getErrors();
            foreach ($errors as $errorArr) {
                if (is_array($errorArr)) {
                    $message[] = implode(', ', $errorArr);
                }
            }
            throw new \Exception(implode(', ', $message), 404);
        }
        return $result;
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    public function newAvatar($url)
    {
        $avatar = new Avatar();
        $avatar->creator_id = $this->id;
        $avatar->url = $url;
        if (!$avatar->save()) {
            return false;
        }
        $this->avatar_id = $avatar->id;
        return $this->save();
    }
}
