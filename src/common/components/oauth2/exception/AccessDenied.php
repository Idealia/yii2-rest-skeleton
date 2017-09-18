<?php

namespace common\components\oauth2\exception;


class AccessDenied extends Exception
{

    public function getError()
    {
        return 'access_denied';
    }

}