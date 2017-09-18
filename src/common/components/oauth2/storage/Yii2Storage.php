<?php
/**
 * @copyright Copyright (c) 2016. nGroup System Sp. z o.o.
 * @name eTrener
 * @version 0.0.1
 * @link http://ngroup.pl
 */

/**
 * Created by PhpStorm.
 * User: piotrek
 * Date: 17.11.16
 * Time: 10:41
 */

namespace common\components\oauth2\storage;


use common\models\User;
use OAuth2\Storage\AccessTokenInterface;
use OAuth2\Storage\ClientCredentialsInterface;
use OAuth2\Storage\RefreshTokenInterface;
use OAuth2\Storage\UserCredentialsInterface;
use yii\base\Component;
use yii\db\Query;

class Yii2Storage extends Component
    implements
    UserCredentialsInterface,
    ClientCredentialsInterface,
    AccessTokenInterface,
    RefreshTokenInterface
{

    /**
     * @inheritdoc
     */
    public function checkUserCredentials($username, $password)
    {
        if ($user = $this->getUser($username)) {
            return $this->_checkPassword($user, $password);
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function getUserDetails($username)
    {
        return $this->getUser($username);
    }

    /**
     * @inheritdoc
     */
    public function checkClientCredentials($client_id, $client_secret = null)
    {
        $result = $this->getClientDetails($client_id);

        return $result && $result['client_secret'] == $client_secret;
    }

    /**
     * @inheritdoc
     */
    public function isPublicClient($client_id)
    {
        return true; // @todo
    }

    /**
     * @inheritdoc
     */
    public function getClientDetails($client_id)
    {
        return (new Query())
            ->from('oauth_client')
            ->where([
                'client_id' => $client_id
            ])
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function getClientScope($client_id)
    {
        return null; // @todo
    }

    /**
     * @inheritdoc
     */
    public function checkRestrictedGrantType($client_id, $grant_type)
    {
        $details = $this->getClientDetails($client_id);
        if (isset($details['grant_types'])) {
            $grant_types = explode(' ', $details['grant_types']);

            return in_array($grant_type, (array)$grant_types);
        }

        return true;
    }


    /**
     * @inheritdoc
     */
    public function getAccessToken($oauth_token)
    {
        $token = (new Query())
            ->from('oauth_access_token')
            ->where(['access_token' => $oauth_token])
            ->one();

        if ($token) {
            $token['expires'] = strtotime($token['expires']);
        }

        return $token;
    }

    /**
     * @inheritdoc
     */
    public function setAccessToken($oauth_token, $client_id, $user_id, $expires, $scope = null)
    {
        $db = \Yii::$app->db;
        $expires = date('Y-m-d H:i:s', $expires);

        if ($this->getAccessToken($oauth_token)) {
            $st = $db
                ->createCommand()
                ->update(
                    'oauth_access_token',
                    [
                        'client_id' => $client_id,
                        'expires' => $expires,
                        'user_id' => $user_id,
                        'scope' => $scope
                    ],
                    [
                        'access_token' => $oauth_token
                    ]
                );
        } else {
            $st = $db->createCommand()
                ->insert(
                    'oauth_access_token',
                    [
                        'access_token' => $oauth_token,
                        'client_id' => $client_id,
                        'expires' => $expires,
                        'user_id' => $user_id,
                        'scope' => $scope
                    ]
                );
        }
        return $st->execute();
    }

    public function unsetAccessToken($token)
    {
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('oauth_access_tokens', [
                'access_token' => $token
            ])
            ->execute();
    }

    /**
     * @inheritdoc
     */
    public function getRefreshToken($refresh_token)
    {
        $token = (new Query())
            ->from('oauth_refresh_token')
            ->where(['refresh_token' => $refresh_token])
            ->one();

        if ($token) {
            $token['expires'] = strtotime($token['expires']);
        }

        return $token;
    }

    /**
     * @inheritdoc
     */
    public function setRefreshToken($refresh_token, $client_id, $user_id, $expires, $scope = null)
    {
        $expires = date('Y-m-d H:i:s', $expires);

        \Yii::$app->db
            ->createCommand()
            ->insert(
                'oauth_refresh_token',
                [
                    'refresh_token' => $refresh_token,
                    'client_id' => $client_id,
                    'expires' => $expires,
                    'user_id' => $user_id,
                    'scope' => $scope
                ]
            )
            ->execute();
    }

    /**
     * @inheritdoc
     */
    public function unsetRefreshToken($refresh_token)
    {
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('oauth_refresh_token', [
                'refresh_token' => $refresh_token
            ])
            ->execute();
    }


    public function getUser($username)
    {
        $user = User::findIdentityByUsername($username);
        if ($user) {
            return [
                'user_id' => $user->id,
                'password_hash' => $user->password_hash
            ];
        }
        return false;
    }

    private function _checkPassword($user, $password)
    {
        return password_verify($password, $user['password_hash']);
    }


}