<?php
/* @var $this GroupsController */

$this->breadcrumbs=array(
	'Groups',
);
?>

<h2>สร้างกลุ่มใหม่</h2>
<div class="form" >

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	//'enableAjaxValidation'=>false,
    //'enableClientValidation'=>true,
        'htmlOptions' => array( 'enctype'=>'multipart/form-data', ),
    )); ?>

	<p class="note"><?= Yii::t("app",'Fields with * are required.');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'Group Name') ); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'Group Description') ); ?>
        <?php echo $form->textArea($model,'description', array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'Group Privacy') ); ?>   
		<div class="compactRadioGroup">
            <?php
                echo $form->radioButtonList($model, 'privacy',
                    array(  
						'Public' => Yii::t("app",'Public'),
                        'Private' => Yii::t("app",'Private'),
                        'Secret' => Yii::t("app",'Secret')
					) );
            ?>
            </div>
        <?php echo $form->error($model,'privacy'); ?>
	</div>
	
	<div class="row">
    	<?php echo $form->labelEx($model, Yii::t("app",'Group Picture') ); ?>
        <?php echo CHtml::activeFileField($model, 'picture'); ?> 
        <?php echo $form->error($model, 'picture'); ?>
    </div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
        
    <hr>

<?php $this->endWidget(); ?>
    
</div><!-- form -->