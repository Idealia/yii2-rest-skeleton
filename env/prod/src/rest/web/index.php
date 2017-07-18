<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

define('__ROOT__', realpath(__DIR__ . '/../../..'));

require_once(__ROOT__ . '/vendor/autoload.php');
require_once(__ROOT__ . '/vendor/yiisoft/yii2/Yii.php');
require_once(__ROOT__ . '/src/common/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__ROOT__ . '/src/common/config/main.php'),
    require(__ROOT__ . '/src/common/config/local.php'),
    require(__ROOT__ . '/src/rest/config/main.php'),
    require(__ROOT__ . '/src/rest/config/local.php')
);

(new yii\web\Application($config))->run();
