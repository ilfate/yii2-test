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
 * @property string $url
 * @property integer $created_at
 * @property integer $updated_at
 */
class Avatar extends ActiveRecord
{

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
}
