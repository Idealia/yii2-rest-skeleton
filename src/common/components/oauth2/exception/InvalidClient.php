<?php

namespace common\components\oauth2\exception;


class InvalidClient extends Exception
{

    public function getError()
    {
        return 'invalid_client';
    }

}