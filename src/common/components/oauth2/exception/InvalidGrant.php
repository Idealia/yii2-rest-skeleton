<?php
/**
 * Created by IntelliJ IDEA.
 * User: piotrek
 * Date: 18.09.17
 * Time: 23:04
 */

namespace common\components\oauth2\exception;


class InvalidGrant extends Exception
{

    public function getError()
    {
        return 'invalid_grant';
    }

}