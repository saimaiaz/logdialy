<h2><?=Yii::t("app",'editpassword')?></h2>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'users-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data',) , 
)); ?>

	<p class="note">User <?=$_GET['id']?></p>

	<?php echo $form->errorSummary($model); ?>
	<?php
		foreach(Yii::app()->user->getFlashes() as $key => $message) {
			echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		}
	?>

	<div class="row">
		<?php echo $form->labelEx($model, Yii::t("app",'Old Password')); ?>
		<?php echo $form->passwordField($model,'old_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'old_password'); ?>
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


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->