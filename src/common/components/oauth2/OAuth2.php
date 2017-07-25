<?php
/**
 * @copyright Copyright (c) 2016. nGroup System Sp. z o.o.
 * @name eTrener
 * @version 0.0.1
 * @link http://ngroup.pl
 */

namespace common\components\oauth2;


use common\components\oauth2\storage\Yii2Storage;
use OAuth2\Server;
use yii\base\Component;

class OAuth2 extends Component
{

    public $storage_options = [];
    public $server_options = [];

    private static $_server = null;
    private static $_storage = null;

    /**
     * @return Server
     */
    public function getServer()
    {
        if (static::$_server == null) {
            $this->_createServer();
        }
        return static::$_server;
    }

    /**
     * @return Yii2Storage
     */
    public function getStorage()
    {
        if (static::$_storage == null) {
            $this->_createStorage();
        }
        return static::$_storage;
    }


    private function _createServer()
    {
        static::$_server = new \OAuth2\Server($this->getStorage(), $this->server_options);
    }

    private function _createStorage()
    {
        static::$_storage = new Yii2Storage($this->storage_options);
    }


}