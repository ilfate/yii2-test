<?php

use yii\db\Schema;
use yii\db\Migration;

class m151130_120250_deleteAccountTocken extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'delete_account_token', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('user', 'delete_account_token');
    }
}
