<?php

namespace common\components\oauth2\exception;


class RedirectUriMismatch extends Exception
{

    public function getError()
    {
        return 'redirect_uri_mismatch';
    }

}