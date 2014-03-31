<?php
/* @var $this PagesController */

$this->breadcrumbs=array(
	'Pages',
);
?>

<h1><?php echo Yii::t("app",'Pages'); ?></h1>

<?php echo CHtml::link(Yii::t("app",'Create new page'),array('pages/create')); ?>

<hr>

<div>
<ul>
	<?php
		//echo count($model);	exit;
 foreach( $model as  $v ){ ?>
		<li><?php echo CHtml::link('Page '.$v->name ,array('pages/show/id/'.$v->id )); ?></li>	
	<?php } ?>
</ul>
</div>