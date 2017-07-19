<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator \common\components\gii\generators\rest\Generator */

echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'baseControllerClass');

echo $form->field($generator, 'url');
echo $form->field($generator, 'apiGroup');
echo $form->field($generator, 'version');
echo $form->field($generator, 'actions');