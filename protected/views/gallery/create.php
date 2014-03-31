

<h1><?= Yii::t("app",'Gallery');?> </h1>

<div class="form">

    <?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'gallery-form',
        'htmlOptions' => array( 'enctype'=>'multipart/form-data', ),
    )); 
	?>

	<p class="note"><?= Yii::t("app",'Fields with * are required.');?></p>

	<?php echo $form->errorSummary($model); ?>
		
	<?php 
	echo $form->hiddenField($model,'category_id',array('value'=>'7')); 
	?>
		
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'*Title') );  ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
	</div>

    <div class="row">
    	<?php echo $form->labelEx($model, Yii::t("app",'Picture')); ?>
        <input type="file" name="picture[]"  multiple />
        <?php echo $form->error($model, 'picture'); ?>
    </div>

	<div class="row">
    	<?php echo $form->labelEx($model, Yii::t("app",'record_time')); ?>
        <?php 			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'date_update',
				'language' => Yii::app()->language,				
				'htmlOptions' => array(
					'size' => '10',         // textField size
					'maxlength' => '10',    // textField maxlength
					'dateFormat'=>'dd-mm-yy',
					'style'=>'height:20px;'					
				),
			));			
		?> 
        <?php echo $form->error($model, 'picture'); ?>
    </div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("app",'Create') : Yii::t("app",'Save') ); ?>
	</div>
        
    <hr>

<?php $this->endWidget(); ?>
    
</div><!-- form -->
