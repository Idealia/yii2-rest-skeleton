<?php
/**
 * Created by IntelliJ IDEA.
 * User: piotrek
 * Date: 18.09.17
 * Time: 15:51
 */

namespace common\components\oauth2\models;


use yii\db\ActiveRecord;

class AccessToken extends ActiveRecord
{
    public static function tableName()
    {
        return 'oauth_access_token';
    }


}