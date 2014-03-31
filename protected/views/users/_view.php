<?php
/* @var $this UsersController */
/* @var $data Users */
?>



<div class="view">

<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
-->

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app', 'firstname'))); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app', 'lastname'))); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app', 'username'))); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app', 'password'))); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app', 'age'))); ?>:</b>
	<?php echo CHtml::encode($data->age); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel(Yii::t('app', 'sex'))); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />
	
	
	<p><?php echo CHtml::link(Yii::t('app', 'Showprofile') , array('showprofile', 'id'=>$data->id)); ?>
	<br><?php echo CHtml::link(Yii::t('app', 'Change password') , array('changepassword', 'id'=>$data->id)); ?>
	<br><?php echo CHtml::link(Yii::t('app', 'Edit') , array('edit', 'id'=>$data->id)); ?></p>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permission')); ?>:</b>
	<?php echo CHtml::encode($data->permission); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php echo CHtml::encode($data->picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group_id); ?>
	<br />

	*/ ?>

</div>