<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t("app",'Register'); ?> </h1>

<?php echo $this->renderPartial('_form_register', array('model'=>$model)); ?>