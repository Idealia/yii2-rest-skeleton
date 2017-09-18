<?php

namespace common\components\oauth2\exception;


class ServerError extends Exception
{

    public function getError()
    {
        return 'server_error';
    }

}