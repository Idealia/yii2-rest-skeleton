<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */


namespace common\components\behaviors;

use common\components\oauth2\exception\AccessDenied;
use common\components\oauth2\exception\Exception;
use common\components\oauth2\exception\InvalidGrant;
use common\components\oauth2\exception\InvalidRequest;
use common\components\oauth2\exception\ServerError;
use common\components\oauth2\models\AccessToken;
use yii\filters\auth\AuthMethod;

/**
 * Class TokenAuth
 * @package common\components\behaviors
 */
class TokenAuth extends AuthMethod
{

    private $_accessToken;
    /**
     * @var string the HTTP authentication realm
     */
    public $realm;
    /**
     * @var string the class name of the [[identity]] object.
     */
    public $identityClass;

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $this->getAccessToken();
        /* @var $user \yii\web\User */
        $identityClass = is_null($this->identityClass) ? $user->identityClass : $this->identityClass;
        $identity = $identityClass::findIdentity($accessToken->user_id);
        if (empty($identity)) {
            throw new AccessDenied('User is not found.');
        }
        $user->setIdentity($identity);
        return $identity;
    }

    /**
     * @inheritdoc
     */
    public function challenge($response)
    {
        $realm = empty($this->realm) ? $this->owner->getUniqueId() : $this->realm;
        $response->getHeaders()->set('WWW-Authenticate', "Bearer realm=\"{$realm}\"");
    }

    /**
     * @inheritdoc
     */
    public function handleFailure($response)
    {
        throw new ServerError('You are requesting with an invalid credential.');
    }

    /**
     *
     * @throws Exception
     */
    protected function getAccessToken()
    {
        if (is_null($this->_accessToken)) {
            $request = \Yii::$app->request;
            $authHeader = $request->getHeaders()->get('Authorization');
            $postToken = $request->post('access_token');
            $getToken = $request->get('access_token');
            // Check that exactly one method was used
            $methodsCount = isset($authHeader) + isset($postToken) + isset($getToken);
            if ($methodsCount > 1) {
                throw new InvalidRequest('Only one method may be used to authenticate at a time (Auth header, POST or GET).');
            } elseif ($methodsCount == 0) {
                throw new InvalidRequest('The access token was not found.');
            }
            // HEADER: Get the access token from the header
            if ($authHeader) {
                if (preg_match("/^Bearer\\s+(.*?)$/", $authHeader, $matches)) {
                    $token = $matches[1];
                } else {
                    throw new InvalidRequest('Malformed auth header.');
                }
            } else {
                // POST: Get the token from POST data
                if ($postToken) {
                    if (!$request->isPost) {
                        throw new InvalidRequest('When putting the token in the body, the method must be POST.');
                    }
                    // IETF specifies content-type. NB: Not all webservers populate this _SERVER variable
                    if ($request->contentType != 'application/x-www-form-urlencoded') {
                        throw new InvalidRequest('The content type for POST requests must be "application/x-www-form-urlencoded"');
                    }
                    $token = $postToken;
                } else {
                    $token = $getToken;
                }
            }
            if (!$accessToken = AccessToken::findOne(['access_token' => $token])) {
                throw new InvalidGrant('The access token provided is invalid.');
            }
            if ($accessToken->expires < time()) {
                throw new InvalidGrant('The access token provided has expired.');
            }
            $this->_accessToken = $accessToken;
        }
        return $this->_accessToken;
    }

    /**
     * Additional rules for oAuth2
     *
     * @param \yii\base\Action $action Performed action
     *
     * @return bool
     * @throws \Exception
     */
    public function beforeAction($action)
    {
        try {
            $result = parent::beforeAction($action);
        } catch (Exception $e) {

            $code = $e->getCode();

            \Yii::$app->response->setStatusCode($code);
            \Yii::$app->response->content = json_encode(
                [
                    'error' => $e->getError(),
                    'message' => $e->getMessage()
                ]
            );

            return false;
        }

        return $result;
    }

}