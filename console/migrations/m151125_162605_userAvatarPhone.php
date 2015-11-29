<?php

use yii\db\Migration;

class m151125_162605_userAvatarPhone extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'avatar_id', $this->integer());
        $this->addColumn('user', 'phone', $this->string(20));
        $this->addForeignKey('FK_user_avatar_id', 'user', 'avatar_id', 'avatar', 'id');
    }

    public function down()
    {
        $this->dropColumn('user', 'avatar_id');
        $this->dropColumn('user', 'phone');
        $this->dropForeignKey('FK_user_avatar_id', 'user');
    }
}
