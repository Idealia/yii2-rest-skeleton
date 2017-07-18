<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

return [
    'id' => 'test',
    'basePath' => __ROOT__,
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
];