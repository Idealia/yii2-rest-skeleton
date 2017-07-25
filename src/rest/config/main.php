<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

$config = [
    'id' => 'rest-api',
    'language' => 'en',
    'basePath' => __ROOT__,
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => \rest\versions\v1\Module::class
        ]
    ],
    'components' => [
        'oauth2' => [
            'class' => \common\components\oauth2\OAuth2::class,
            'server_options' => [
                'token_param_name' => 'access_token',
                'access_lifetime' => 3600 * 24
            ],
//            'storageMap' => [
//                'user_credentials' => 'common\models\Account'
//            ],
//            'grantTypes' => [
//                'client_credentials' => [
//                    'class' => 'OAuth2\GrantType\ClientCredentials',
//                    'allow_public_clients' => false
//                ],
//                'user_credentials' => [
//                    'class' => 'OAuth2\GrantType\UserCredentials'
//                ],
//                'refresh_token' => [
//                    'class' => 'OAuth2\GrantType\RefreshToken',
//                    'always_issue_new_refresh_token' => true
//                ]
//            ],
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => [
                    'class' => 'yii\web\JsonParser',
                    'prettyPrint' => true
                ]
            ],
        ],
        'response' => [
            'charset' => 'UTF-8',
//            'format' => isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'],
//                '/gii') !== false ? yii\web\Response::FORMAT_HTML : yii\web\Response::FORMAT_JSON,
            'format' => yii\web\Response::FORMAT_JSON,
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                ],
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => \common\models\User::class,
            'enableAutoLogin' => true,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
];

return $config;
