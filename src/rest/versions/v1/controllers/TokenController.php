<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

namespace rest\versions\v1\controllers;

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
class TokenController extends \yii\rest\Controller
{
//    public function behaviors()
//    {
//        return [
//            'oauth2Auth' => [
//                'class' => \conquer\oauth2\AuthorizeFilter::className(),
//                'only' => ['index'],
//            ],
//        ];
//    }

    public function actions()
    {
        return [
            'index' => [
                'class' => \conquer\oauth2\TokenAction::classname(),
                'grantTypes' => [
                    'refresh_token' => 'conquer\oauth2\granttypes\RefreshToken',
                    'password' => 'conquer\oauth2\granttypes\UserCredentials',
                ]
            ],
        ];
    }

}