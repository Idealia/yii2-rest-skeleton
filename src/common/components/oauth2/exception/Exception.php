<?php

namespace common\components\oauth2\exception;

abstract class Exception extends \yii\base\Exception
{

    public $code = 403;

    abstract public function getError();


}