<?php
/**
 * Created by IntelliJ IDEA.
 * User: piotrek
 * Date: 18.09.17
 * Time: 15:46
 */

namespace rest\versions\v1\controllers;


use common\components\behaviors\TokenAuth;
use yii\rest\Controller;

class TestController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'authenticator' => [
                'class' => TokenAuth::class
            ]
        ]);
    }


    public function actionIndex()
    {
        return ['a' => 'b'];
    }

}