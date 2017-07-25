<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

namespace rest\versions\v1\controllers;

use common\components\oauth2\OAuth2;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\RefreshToken;
use OAuth2\GrantType\UserCredentials;
use yii\rest\Controller;


/**
 * @api {post} /token oAuth2 token endpoint
 * @apiName Sign in
 * @apiGroup Auth
 * @apiVersion 0.1.0
 * @apiPermission none
 *
 * @apiParam {String} client_id Oauth Client Id.
 * @apiParam {String=password,refresh_token} grant_type oAuth grant type.
 * @apiParam {String} username User login (email address).
 * @apiParam {String} password User password.
 *
 * @apiSampleRequest https://api.dev/token
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "access_token": "...",
 *         "expires_in": 3600,
 *         "token_type": "bearer",
 *         "scope": null,
 *         "refresh_token": "..."
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 500 Internal Server Error
 *     {
 *          "name": "invalid_request",
 *          "message": "Invalid username or password",
 *          "code": 0,
 *          "type": "conquer\\oauth2\\Exception"
 *     }
 *
 */
class AuthController extends Controller
{

    /**
     * @var OAuth2
     */
    public $oauth2;

    public function init()
    {
        parent::init();
        $this->oauth2 = \Yii::$app->oauth2;
    }


    public function actionToken()
    {
        $server = $this->oauth2->getServer();
        $storage = $this->oauth2->getStorage();

        $server->addGrantType(new UserCredentials($storage));
        $server->addGrantType(new ClientCredentials($storage));
        $server->addGrantType(new RefreshToken($storage, [
            'always_issue_new_refresh_token' => true,
        ]));

        $result = $server->handleTokenRequest(\OAuth2\Request::createFromGlobals());

        \Yii::$app->response->setStatusCode($result->getStatusCode());
        return $result->getParameters();

    }

    public function actionRevoke()
    {
        $server = $this->oauth2->getServer();
        $storage = $this->oauth2->getStorage();

        $server->addGrantType(new ClientCredentials($storage));
        $server->addGrantType(new UserCredentials($storage));

        $result = $server->handleRevokeRequest(\OAuth2\Request::createFromGlobals());

        \Yii::$app->response->setStatusCode($result->getStatusCode());
    }

}