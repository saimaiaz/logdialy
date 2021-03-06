<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'users-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data',) , 
)); ?>

	<p class="note"></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, Yii::t("app",'firstname') ); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model, 'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Lastname')); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, Yii::t("app",'Username') ); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, Yii::t("app",'Password')); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, Yii::t("app",'Confirm Password')); ?>
		<?php echo $form->passwordField($model,'confirm_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'confirm_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Age')); ?>
		<?php echo $form->textField($model,'age'); ?>
		<?php echo $form->error($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Sex')); ?>
		<?php echo $form->textField($model,'sex',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Address')); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Email')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Telephone')); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>13,'maxlength'=>13)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

<!--
	<div class="row">
		<?php echo $form->labelEx($model, Yii::t("app",'Permission')); ?>
		<?php echo $form->textField($model,'permission',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'permission'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id'); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>
	
-->

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t("app",'Picture')); ?>
		<?php echo CHtml::activeFileField($model, 'picture'); ?>
		<?php echo $form->error($model,'picture'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->