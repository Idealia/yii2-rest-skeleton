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
 * Time: 13:28
 */

namespace common\components\oauth2\filters;


use OAuth2\Request;
use OAuth2\Response;
use yii\filters\auth\AuthInterface;
use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;

class Auth extends AuthMethod implements AuthInterface
{


    /**
     * @var Request
     */
    public $oauth_request;

    /**
     * @var Response
     */
    public $oauth_response;


    public function authenticate($user, $request, $response)
    {

        /**
         * @var $module OAuth2
         */
        $module = \Yii::$app->oauth2;
        $oauthServer = $module->getServer();

        $this->oauth_request = Request::createFromGlobals();
        $this->oauth_response = new Response();

        if ($oauthServer->verifyResourceRequest($this->oauth_request, $this->oauth_response)) {
            $token = $oauthServer->getResourceController()->getToken();
            if (!empty($token)) {
                $identity = $user->loginByAccessToken($token);
                return $identity;
            }
        }

        return null;
    }


    /**
     * Generates challenges upon authentication failure.
     * For example, some appropriate HTTP headers may be generated.
     * @param \yii\web\Response $response
     */
    public function challenge($response)
    {

    }

    /**
     * Handles authentication failure.
     * The implementation should normally throw UnauthorizedHttpException to indicate authentication failure.
     * @param \yii\web\Response $response
     * @throws UnauthorizedHttpException
     */
    public function handleFailure($response)
    {
        \Yii::$app->response->setStatusCode($this->oauth_response->getStatusCode());
        \Yii::$app->response->content = json_encode($this->oauth_response->getParameters());
    }

}