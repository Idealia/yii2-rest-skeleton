<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

$config = [];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'rest' => \common\components\gii\generators\rest\Generator::class
        ]
    ];
}

return $config;
