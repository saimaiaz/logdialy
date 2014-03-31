<?php
/* @var $this PagesController */

$this->breadcrumbs=array(
	'Pages',
);
?>

<h2>สร้างเพจใหม่</h2>
<div class="form" >

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	//'enableAjaxValidation'=>false,
    //'enableClientValidation'=>true,
        'htmlOptions' => array( 'enctype'=>'multipart/form-data', ),
    )); ?>

	<!--<p class="note"><?= Yii::t("app",'Fields with * are required.');?></p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'Page Name') ); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'Page Category') ); ?>
        <?php echo $form->dropdownList($model, 'category', array('Temple'=>Yii::t("app",'Temple'), 'Organization'=>Yii::t("app",'Organization'), 'Activity'=>Yii::t("app",'Activity'), 'People'=>Yii::t("app",'People')) , array('prompt'=>Yii::t("app",'Choose page category'))); ?>
        <?php echo $form->error($model, 'category'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'Page Description') ); ?>
        <?php echo $form->textArea($model,'description', array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">
    	<?php echo $form->labelEx($model, Yii::t("app",'Page Picture') ); ?>
        <?php echo CHtml::activeFileField($model, 'picture'); ?> 
        <?php echo $form->error($model, 'picture'); ?>
    </div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
        
    <hr>

<?php $this->endWidget(); ?>
    
</div><!-- form -->