<?php

namespace common\components\oauth2\exception;


class UnauthorizedClient extends Exception
{

    public function getError()
    {
        return 'unauthorized_client';
    }

}