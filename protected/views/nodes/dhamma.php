<?php
/* @var $this NodesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Nodes',
);

$this->menu=array(
    array('label'=>'Create Nodes', 'url'=>array('create')),
    array('label'=>'Manage Nodes', 'url'=>array('admin')),
);
?>

<h1><?= Yii::t("app",'dhamma');?> </h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nodes-form',
	//'enableAjaxValidation'=>false,
    //'enableClientValidation'=>true,
        'htmlOptions' => array( 'enctype'=>'multipart/form-data', ),
    )); ?>

	<p class="note"><?= Yii::t("app",'Fields with * are required.');?></p>

	<?php echo $form->errorSummary($model); ?>
		
	<?php 
	// category 3 for dhamma
	echo $form->hiddenField($model,'category_id',array('value'=>'3')); 
	?>
		
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'*Title') ); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'*Text') ); ?>
        <?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'text'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'*samma') ); ?>
        <?php echo $form->textField($model,'samma',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'samma'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'*time_samati') ); ?>
        <?php echo $form->textField($model,'time_samati',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'time_samati'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, Yii::t("app",'*goodness') ); ?>
        <?php echo $form->textField($model,'goodness',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'goodness'); ?>
	</div>

    <div class="row">
    	<?php echo $form->labelEx($model, Yii::t("app",'Picture')); ?>
        <?php echo CHtml::activeFileField($model, 'picture'); ?> 
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
        <?php echo CHtml::submitButton($model->isNewRecord ?   Yii::t("app",'Create') : Yii::t("app",'Save')  ); ?>
	</div>
        
    <hr>

<?php $this->endWidget(); ?>
    
</div><!-- form -->

<div id="boon-post">
<?php 
foreach ($dataProvider as $k => $v) {
    
?>    
    
    <div style="box-sizing: border-box; " class="boon-posts">
		<div style="" id="profile">
			
			<p>
				<img width="50" src="<?php echo Yii::app()->baseUrl.'/profilepicture/'.CHtml::decode($v->users->picture); ?>"> 
			<!-- <a href=""><?php echo $v->users->firstname; ?></a> -->
				 <?php echo CHtml::link($v->users->firstname, array('users/'.$v->users->id)); ?>
			</p>
			
		</div>
        <div style="float: left; padding-left: 52px;">
		
			<!-- <p>Title: <?php echo CHtml::decode($v['title']); ?></p>-->
            
			<p>
				<?php if($v['picture']){ ?>
				<a  target="_BLANK" rel="prettyPhoto[gallery2]" href="<?=Yii::app()->createUrl('gallery/show/', array('id'=>$v->id) ); ?>">
					<img width="150" src="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $v['picture']; ?>" /> 
					</a>
				<?php } ?>
			</p>
			
			<?php
				$a = json_decode($v['text'], true);
			?>
            <p><?=Yii::t("app",'Text') ?> : <?php echo $a['text'] ?></p>
            <p><?=Yii::t("app",'*samma') ?> : <?php echo $a['samma'] ?></p>
            <p><?=Yii::t("app",'*time_samati') ?> : <?php echo $a['time_samati'] ?></p>
            <p><?=Yii::t("app",'*goodness') ?> : <?php echo $a['goodness'] ?></p>
			
            
			
			<div class="comment comment<?php echo $v['id']; ?>">
				<?php 
				$comment = $v->comment;
				foreach( $comment as $vc ){
				?>
				<p>
					<img width="30" src="<?php echo Yii::app()->baseUrl.'/profilepicture/'.$vc->users->picture; ?>" /> 
					<?php echo urldecode($vc->users->firstname); ?> พูดว่า: 
				</p>
				<p style="padding-left: 34px;"><?php echo urldecode($vc->text); ?></p>
				<?php } ?>
			</div>
			
            <p>
				<textarea id="text<?php echo $v['id']; ?>" style="height: 30px; padding:0; margin:0;"></textarea> 
				<button style="height: 30px; padding:0 10px; margin:0;" onclick="sendComment('<?php echo CHtml::decode($v['id']); ?>', 'text<?php echo $v['id']; ?>', '<?php echo $v->users->id; ?>');"> <?=Yii::t("app",'Send');?> </button>
			</p>
			
        </div>
        
        <div style="clear: both;">
            
            <span onclick="playSatoo(); doSatoo('<?php echo CHtml::decode($v['id']); ?>');">
                <img src="<?php echo Yii::app()->baseUrl.'/images/satoo.png'; ?>" >
            </span>
            <span><?php 
                // satoo
                $satoo = Satoo::model()->findAllByAttributes(
                    array(),
                    $condition = 'node_id=:node_id',
                    $params = array(':node_id'=>$v['id'])
                );
                
                foreach ($satoo as $v) {
                    echo $v->users->firstname.' ';
                }
            ?> <?php if(count($satoo)!=0) { ?>สาธุในสิ่งนี้<?php } ?></span>
        </div>
    </div>
    <div style="border-bottom: 1px #fff solid; clear: both; margin-bottom: 5px; padding-bottom: 5px;"></div>

<?php } ?>
</div>
<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#boon-post',
    'itemSelector' => 'div.boon-posts',
    'loadingText' => Yii::t("app",'Loading...'),
    'donetext' => Yii::t("app",'end of content'),
    'pages' => $pages,
)); ?>

