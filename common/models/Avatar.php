<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\User;

/**
 * User model
 *
 * @property integer $id
 * @property string $url
 * @property integer $creator_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Avatar extends ActiveRecord
{
    const AVATAR_PLACEHOLDER = '/images/avatar-placeholder.png';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%avatar}}';
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
     * Finds avatar by user
     *
     * @param User $user
     *
     * @return null|static
     */
    public static function findByUser(User $user)
    {
        if ($user->avatar_id) {
            return static::findOne(['id' => $user->avatar_id]);
        }
        return null;
    }

    /**
     * Finds avatar by id
     *
     * @param int $id
     *
     * @return null|static
     */
    public static function findById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public function getUrl()
    {
        return $this->url ?: self::AVATAR_PLACEHOLDER;
    }
}
