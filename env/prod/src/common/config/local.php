<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=faktura',
            'username' => 'root',
            'password' => 'pudop',
            'charset' => 'utf8',
        ],
    ],
];
