<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

/**
 * Created by PhpStorm.
 * User: piotrek
 * Date: 04.07.17
 * Time: 10:35
 */

namespace rest\versions\v1\models;


use common\models\User;
use yii\base\Exception;

class RegisterForm extends User
{

    public $password;
    public $rules;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['password', 'string', 'min' => 8],
            [
                'rules', 'required', 'requiredValue' => 1,
                'message' => \Yii::t('app', 'Akceptacja regulaminu jest wymagana')
            ]
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->setPassword($this->password);
        if (!$this->save(false)) {
            throw new Exception("There is an error?");
        }

        return true;
    }

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'password' => \Yii::t('app', 'Hasło'),
                'rules' => \Yii::t('app', 'Regulamin'),
            ]
        );
    }

}