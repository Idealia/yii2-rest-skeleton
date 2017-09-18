<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */


namespace rest\versions\v1\controllers;

use common\components\oauth2\filters\Auth;
use rest\versions\v1\models\RegisterForm;
use yii\rest\Controller;

/**
 * @api {post} /register New user registration
 * @apiName Registration
 * @apiGroup Auth
 * @apiVersion 0.1.0
 * @apiPermission none
 *
 * @apiParam {String} email Email address.
 * @apiParam {String{8..50}} password Password.
 * @apiParam {Boolean=1} rules Rules.
 *
 * @apiSampleRequest https://api.dev/register
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "status": 10
 *         "email": "mail@example.com",
 *         "created_at": "2017-07-04 21:24:07",
 *         "updated_at": "2017-07-04 21:24:07",
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 422 Data Validation Failed.
 *     [
 *          {
 *              "field": "password",
 *              "message": "Password is required."
 *          },
 *          {
 *              "field": "email",
 *              "message": "Email \"mail@example.com\" has already been taken."
 *          },
 *          {
 *              "field": "rules",
 *              "message": "Acceptance of the regulations is mandatory."
 *          }
 *     ]
 */
class RegisterController extends Controller
{

    public function actionIndex()
    {
        $model = new RegisterForm();
        $model->load(\Yii::$app->request->post(), '');
        $model->register();
        return $model;
    }
}