<?php

namespace common\components\oauth2\exception;

class UnsupportedResponseType extends Exception
{

    public function getError()
    {
        return 'unsupported_response_type';
    }

}