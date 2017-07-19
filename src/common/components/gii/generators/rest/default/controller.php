<?php
/**
 * This is the template for generating a REST controller class file.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator \common\components\gii\generators\rest\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);

$active = $generator->baseControllerClass == 'yii\rest\ActiveController';

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use common\components\behaviors\TokenAuth
use <?= ltrim($generator->modelClass, '\\') ?>;
use <?= ltrim($generator->baseControllerClass, '\\') ?>;

/**
* @apiDefine <?= $controllerClass ?> <?= $generator->apiGroup . "\n"; ?>
*/
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
<?php if (1): /* todo */ ?>
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => TokenAuth::class
        ];
        return $behaviors;
    }
<?php endif; ?>

<?php if ($active): ?>

    /**
     * @inheritdoc
     */
    public $modelClass = <?= $modelClass ?>::class;

    /**
     * @inheritdoc
     */
    public function checkAccess($action, $model = null, $params = [])
    {

    }

    /**
     * @api {get} <?= $generator->url; ?> 1. Records list
     * @apiGroup <?= $controllerClass . "\n"; ?>
     * @apiVersion <?= $generator->version . "\n"; ?>
     */

    /**
     * @api {get} <?= $generator->url; ?>/:id 2. Get one record
     * @apiGroup <?= $controllerClass . "\n"; ?>
     * @apiVersion <?= $generator->version . "\n"; ?>
     */

    /**
     * @api {post} <?= $generator->url; ?> 3. Create record
     * @apiGroup <?= $controllerClass . "\n"; ?>
    <?php foreach ($generator->getModelParams() as $param): ?>
 * @apiParam {<?= ucfirst($param['type']) ?>} <?= $param['name'] ?> <?= $param['label']; ?>.
    <?php endforeach; ?>
 * @apiVersion <?= $generator->version . "\n"; ?>
     */

    /**
     * @api {put} <?= $generator->url; ?>/:id 4. Update record
     * @apiGroup <?= $controllerClass . "\n"; ?>
    <?php foreach ($generator->getModelParams() as $param): ?>
 * @apiParam {<?= ucfirst($param['type']) ?>} <?= $param['name'] ?> <?= $param['label']; ?>.
    <?php endforeach; ?>
 * @apiVersion <?= $generator->version . "\n"; ?>
     * @apiVersion <?= $generator->version . "\n"; ?>
     */

    /**
     * @api {delete} <?= $generator->url; ?>/:id 5. Delete record
     * @apiGroup <?= $controllerClass . "\n"; ?>
     * @apiVersion <?= $generator->version . "\n"; ?>
     */
<?php endif; ?>

<?php foreach ($generator->getActionIDs() as $action): ?>
    /**
     * @api {get} <?= $generator->url; ?>/<?= $action; ?> fixme
     * @apiGroup <?= $controllerClass . "\n"; ?>
     * @apiVersion <?= $generator->version . "\n"; ?>
     */
    public function action<?= Inflector::id2camel($action) ?>()
    {

    }

<?php endforeach; ?>
}
