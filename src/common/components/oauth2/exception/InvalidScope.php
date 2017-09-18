<?php

namespace common\components\oauth2\exception;


class InvalidScope extends Exception
{

    public function getError()
    {
        return 'invalid_scope';
    }

}