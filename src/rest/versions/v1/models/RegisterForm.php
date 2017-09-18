<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */


namespace rest\versions\v1\models;

use common\models\User;
use yii\base\Exception;

/**
 * Class RegisterForm
 * @package rest\versions\v1\models
 */
class RegisterForm extends User
{

    /**
     * @var String User new password
     */
    public $password;

    /**
     * @var boolean Did user accept rules?
     */
    public $rules;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [
                'password', 'string', 'min' => 8,
                'message' => \Yii::t('app', 'Password is too weak.')
            ],
            [
                'rules', 'required', 'requiredValue' => 1,
                'message' => \Yii::t('app', 'Acceptance of the regulations is mandatory.')
            ]
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->setPassword($this->password);
        if (!$this->insert(false)) {
            throw new Exception("There is an error?");
        }

        $this->refresh();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'password' => \Yii::t('app', 'Password'),
                'rules' => \Yii::t('app', 'Rules'),
            ]
        );
    }

}