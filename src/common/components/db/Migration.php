<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

/**
 * Created by PhpStorm.
 * User: piotrek
 * Date: 04.07.17
 * Time: 10:39
 */

namespace common\components\db;


class Migration extends \yii\db\Migration
{
    public function createTable($table, $columns, $options = null)
    {
        if ($options === null && $this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        parent::createTable($table, $columns, $options);
    }

}