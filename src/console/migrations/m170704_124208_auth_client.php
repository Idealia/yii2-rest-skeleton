<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

use yii\db\Migration;

class m170704_124208_auth_client extends Migration
{
    public function safeUp()
    {
        $this->insert('oauth2_client', [
            'client_id' => '232af83f-1013-4729-bce2-8a19af6b9240',
            'client_secret' => '',
            'redirect_uri' => '',
            'created_at' => time(),
            'updated_at' => time(),
            'created_by' => 0,
            'updated_by' => 0,
        ]);
    }

    public function safeDown()
    {
        echo "m170704_124208_auth_client cannot be reverted.\n";

        return false;
    }

}
