<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */


class m170704_112144_oauth2 extends \common\components\db\Migration
{

    public function safeUp()
    {

        $this->createTable('oauth_client', [
            'client_id' => $this->string(80),
            'client_secret' => $this->string(80),
            'redirect_uri' => $this->text(),
            'grant_type' => $this->text(),
            'scope' => $this->text(),
            'created_at' => 'TIMESTAMPTZ',
            'updated_at' => 'TIMESTAMPTZ',
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->createTable('oauth_access_token', [
            'access_token' => $this->string(40),
            'client_id' => $this->string(80),
            'user_id' => $this->integer(),
            'expires' => 'TIMESTAMPTZ',
            'scope' => $this->text()
        ]);

        $this->createTable('oauth_refresh_token', [
            'refresh_token' => $this->string(40),
            'client_id' => $this->string(80),
            'user_id' => $this->integer(),
            'expires' => 'TIMESTAMPTZ',
            'scope' => $this->text()
        ]);

        $this->createTable('oauth_authorization_code', [
            'access_token' => $this->string(40),
            'client_id' => $this->string(80),
            'user_id' => $this->integer(),
            'redirect_uri' => $this->text(),
            'expires' => 'TIMESTAMPTZ',
            'scope' => $this->text()
        ]);

        $this->addPrimaryKey('oauth_client_pkey', 'oauth_client', 'client_id');
        $this->addPrimaryKey('oauth_access_token_pkey', 'oauth_access_token', 'access_token');
        $this->addPrimaryKey('oauth_refresh_token_pkey', 'oauth_refresh_token', 'refresh_token');
        $this->addPrimaryKey('oauth_authorization_code_pkey', 'oauth_authorization_code', 'access_token');

    }

}
