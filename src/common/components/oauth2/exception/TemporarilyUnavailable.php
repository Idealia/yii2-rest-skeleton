<?php

namespace common\components\oauth2\exception;


class TemporarilyUnavailable extends Exception
{

    public function getError()
    {
        return 'temporarily_unavailable';
    }

}