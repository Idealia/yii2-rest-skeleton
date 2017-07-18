<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

/**
 * Created by PhpStorm.
 * User: piotrek
 * Date: 04.07.17
 * Time: 10:34
 */

namespace rest\versions\v1\controllers;


use rest\versions\v1\models\RegisterForm;
use yii\rest\Controller;

/**
 * @api {post} /register Rejestracja nowego użytkownika
 * @apiName Rejestracja
 * @apiGroup Autoryzacja
 * @apiVersion 0.1.0
 * @apiPermission none
 *
 * @apiParam {String} email Adres email.
 * @apiParam {String{8..50}} password Hasło.
 * @apiParam {Boolean=1} rules Akceptacja regulaminu.
 *
 * @apiSampleRequest https://fapi.dev/register
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "status": 10
 *         "email": "piotr2@codeexpert.pl",
 *         "created_at": "2017-07-04 21:24:07",
 *         "updated_at": "2017-07-04 21:24:07",
 *     }
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 422 Data Validation Failed.
 *     [
 *          {
 *              "field": "password",
 *              "message": "Hasło nie może pozostać bez wartości."
 *          },
 *          {
 *              "field": "email",
 *              "message": "Email \"piotr@codeexpert.pl\" jest już w użyciu."
 *          },
 *          {
 *              "field": "rules",
 *              "message": "Akceptacja regulaminu jest wymagana"
 *          }
 *     ]
 */
class RegisterController extends Controller
{
    public function actionIndex()
    {
        $model = new RegisterForm();
        if ($model->load(\Yii::$app->request->post(), '') && $model->register()) {
            $model->refresh();
        }
        return $model;
    }
}