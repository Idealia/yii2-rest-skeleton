<?php

namespace common\components\oauth2\exception;


class UnsupportedGrantType extends Exception
{

    public function getError()
    {
        return 'unsupported_grant_type';
    }

}