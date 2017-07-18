<?php
/**
 * Copyright (c) 2017. Piotr Grzelka <piotr.grzelka@idealia.pl>
 */

namespace common\components\behaviors;


use yii\db\BaseActiveRecord;
use yii\db\Expression;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdAtAttribute, $this->updatedAtAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->updatedAtAttribute,
            ];
        }
    }

    protected function getValue($event)
    {
        return new Expression('now()');
    }
}