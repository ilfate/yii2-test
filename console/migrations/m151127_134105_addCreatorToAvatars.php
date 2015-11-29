<?php

use yii\db\Migration;

class m151127_134105_addCreatorToAvatars extends Migration
{
    public function up()
    {
        $this->addColumn('avatar', 'creator_id', $this->integer());
        $this->addForeignKey('FK_avatar_creator_id', 'avatar', 'creator_id', 'user', 'id');
    }

    public function down()
    {
        $this->dropColumn('avatar', 'creator_id');
        $this->dropForeignKey('FK_avatar_creator_id', 'avatar');
    }
}
