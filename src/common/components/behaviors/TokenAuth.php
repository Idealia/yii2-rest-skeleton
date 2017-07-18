<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

/**
 * Created by PhpStorm.
 * User: piotrek
 * Date: 04.07.17
 * Time: 15:31
 */

namespace common\components\behaviors;


class TokenAuth extends \conquer\oauth2\TokenAuth
{


    /**
     * Dodatkowe warunki dla oAuth2
     *
     * @param \yii\base\Action $action Akcja
     *
     * @return bool
     * @throws \Exception
     */
    public function beforeAction($action)
    {
        try {
            $result = parent::beforeAction($action);
        } catch (\Exception $e) {

            $code = $e->getCode();
            if ($code == 0) {

                switch (true) {
                    case $e->getName() == 'invalid_grant':
                        $code = 403;
                        break;

                    default:
                        $code = 500;
                        break;
                }
            }

            \Yii::$app->response->setStatusCode($code);
            \Yii::$app->response->content = json_encode(
                [
                    'error' => $e->getName()
                ]
            );

            return false;
        }

        return $result;
    }

}