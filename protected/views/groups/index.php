<?php
/* @var $this GroupsController */

$this->breadcrumbs=array(
	'Groups',
);
?>

<h1><?php echo Yii::t("app",'Groups'); ?></h1>

<?php echo CHtml::link(Yii::t("app",'Create new group'), array('groups/create') ); ?>

<hr>

<div>
<ul>
	<?php
		//echo count($model);	exit;
 foreach( $model as  $v ){ ?>
		<li><?php echo CHtml::link('Group '.$v->name ,array('groups/show/id/'.$v->id )); ?></li>	
	<?php } ?>
</ul>
</div>