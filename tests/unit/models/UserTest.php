<?php

namespace tests\models;

use common\models\User;
use yii\web\MethodNotAllowedHttpException;

require_once __ROOT__ . '/src/common/models/User.php';

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserByAccessTokenShouldNotBeAllowed()
    {
        $this->expectException(MethodNotAllowedHttpException::class);
        User::findIdentityByAccessToken('100-token');
    }

    public function testUserValidation()
    {
        $user = new User(['email' => 'valid@example.com']);
        $user->validate();
        $this->assertArrayNotHasKey('email', $user->getErrors());

        $user = new User(['email' => 'invalid.com']);
        $user->validate();
        $this->assertArrayHasKey('email', $user->getErrors());

    }

//    public function testValidateUser()
//    {
//        $user = User::findIdentityByUsername('admin');
//        expect_that($user->validateAuthKey('test100key'));
//        expect_not($user->validateAuthKey('test102key'));
//
//        expect_that($user->validatePassword('admin'));
//        expect_not($user->validatePassword('123456'));
//    }

}
