<?php

namespace common\components\oauth2\exception;


class InvalidRequest extends Exception
{

    public function getError()
    {
        return 'invalid_request';
    }

}