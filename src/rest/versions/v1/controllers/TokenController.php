<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

namespace rest\versions\v1\controllers;

/**
 * @api {post} /token Logowanie za pomocą oAuth2
 * @apiName Logowanie
 * @apiGroup Autoryzacja
 * @apiVersion 0.1.0
 * @apiPermission none
 *
 * @apiParam {String=232af83f-1013-4729-bce2-8a19af6b9240} client_id Adres email.
 * @apiParam {String=password,refresh_token} grant_type Adres email.
 * @apiParam {String} username Adres email.
 * @apiParam {String} password Hasło.
 *
 * @apiSampleRequest https://fapi.dev/token
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