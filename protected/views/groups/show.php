<?php


$v = $gmodel;
//echo gettype($v->name);
?>

<h2> <?php echo Yii::t("app",'Groups').' '.$v->name; //echo 'get p id '.$_GET['id'] ?></h2>

<?php if($v->picture){ ?>
<img src="<?php echo Yii::app()->baseUrl.'/picture/'.$v->picture; ?>" style="max-height: 200px; border: 1px solid #ddd; padding: 10px; margin: 10px 0; " /><?php } ?>

<p><?=Yii::t("app",'Groups name') ?> : <?php echo $v->name; ?> | <?php echo Yii::t("app",'Groups') ?> : <?php echo Yii::t("app", $v->privacy ); ?></p>
<p><?=Yii::t("app",'Groups detail') ?> : <?php echo $v->description; ?> </p>
<P><?=Yii::t("app",'suggest friend label') ?> : 

<input id="suggestfriend" type="hidden" />
<?php 
$umodel = new Users;

$this->widget('zii.widgets.jui.CJuiAutoComplete' ,
array(
      'model'=>$umodel,
      'attribute'=> 'firstname' ,
      'source'=>$this->createUrl('groups/autocomplete?group_id='.$_GET['id']),
      'htmlOptions'=>array('placeholder'=>Yii::t("app",'type friend name')  ),
      'options'=>
         array(
               'showAnim'=>'fold',
               'select'=>"js:function(hotel, ui) {
					$('#suggestfriend').val(ui.item.id);
               }"
                ),
      'cssFile'=>false,
    )
 );
?>

<button onclick="doSuggestfriend();" style="margin-top: -10px;"><?=Yii::t("app",'suggest friend') ?></button></P>

<script>
	function doSuggestfriend(){
		if ( $('#suggestfriend').val().trim()=='' )
		{	return;	 }
		
		$.post( '<?php echo Yii::app()->createUrl('groups/addtogroup')?>' , 
		{user_id: $('#suggestfriend').val() , group_id: '<?=$_GET['id'] ?>' , YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken; ?>'} , 
		function(data) {
			console.log(data);
		});
	}
</script>

<!--  post and comment start here  -->
<hr>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	//'enableAjaxValidation'=>false,
    //'enableClientValidation'=>true,
        'htmlOptions' => array( 'enctype'=>'multipart/form-data', ),
    )); ?>

	<p class="note"><?= Yii::t("app",'Fields with * are required.');?></p>

	<?php echo $form->errorSummary($nmodel); ?>
		
	<?php 
																							// category_id is group_id
	echo $form->hiddenField($nmodel,'category_id',array('value'=> $_GET['id'] )); 
	?>
		
	<div class="row">
        <?php echo $form->labelEx($nmodel, Yii::t("app",'*Title') );  ?>
        <?php echo $form->textField($nmodel,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($nmodel,'title'); ?>
	</div>

	<div class="row">
        <?php echo $form->labelEx($nmodel, Yii::t("app",'*Text') ); ?>
        <?php echo $form->textArea($nmodel,'text',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($nmodel,'text'); ?>
	</div>

    <div class="row">
    	<?php echo $form->labelEx($nmodel, Yii::t("app",'Picture')); ?>
        <?php echo CHtml::activeFileField($nmodel, 'picture'); ?> 
        <?php echo $form->error($nmodel, 'picture'); ?>
    </div>

	<div class="row">
    	<?php echo $form->labelEx($nmodel, Yii::t("app",'record_time')); ?>
        <?php 			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $nmodel,
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
        <?php echo $form->error($nmodel, 'picture'); ?>
    </div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($nmodel->isNewRecord ? Yii::t("app",'Create') : Yii::t("app",'Save') ); ?>
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
				<?php echo CHtml::link($v->users->firstname, array('users/showprofile/id/'.$v->users->id)); ?>
			</p>
			
		</div>
        <div style="float: left; padding-left: 52px;">
		
			<p># <?php echo CHtml::decode($v['title']); ?></p>
			
			<?php if($v['picture']){ ?>				
				<a  target="_BLANK" rel="prettyPhoto[gallery2]" href="<?=Yii::app()->createUrl('gallery/show/', array('id'=>$v->id) ); ?>">
				<img width="150" src="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $v['picture']; ?>" /> 
				</a>				
			<?php } ?>
			</p>
			
			<?php if( $v->category_id == 7 ){ ?>		
		
				[Gallery photo]<br>
					<?php 
					$gJson = json_decode($v['text'] );
					foreach( $gJson as  $g )
					{
						?>
						<a target="_BLANK" rel="prettyPhoto[gallery2]" href="<?=Yii::app()->createUrl('gallery/show/', array('id'=>$v->id) ); ?>">
						<img width="150" src="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $g; ?>" /> 
						</a>
						<?php
					}
					?>
					
			<?php } else if($v->category_id == 2){ ?>
				<?php
					$a = json_decode($v['text'], true);
				?>
				<p><?=Yii::t("app",'Text') ?> : <?php echo $a['text'] ?></p>
				<p><?=Yii::t("app",'*Location') ?> : <?php echo $a['location'] ?></p>
			<?php } else if($v->category_id == 3){ ?>
				<?php
					$a = json_decode($v['text'], true);
				?>
				<p><?=Yii::t("app",'Text') ?> : <?php echo $a['text'] ?></p>
				<p><?=Yii::t("app",'*samma') ?> : <?php echo $a['samma'] ?></p>
				<p><?=Yii::t("app",'*time_samati') ?> : <?php echo $a['time_samati'] ?></p>
				<p><?=Yii::t("app",'*goodness') ?> : <?php echo $a['goodness'] ?></p>
			<?php }else{ ?>
				<p><?php echo CHtml::decode($v['text']); ?></p>
			<?php } ?>
			            
				<p>
				
			
			<div class="comment comment<?php echo $v['id']; ?>">
				<?php 
				foreach( $v->comment as $vc ){					
				?>
				<p>
					<img width="30" src="<?php echo Yii::app()->baseUrl.'/profilepicture/'.$vc->users->picture; ?>" /> 
					
					<?php echo CHtml::link($vc->users->firstname, array('users/showprofile/id/'.$vc->users->id)); ?> พูดว่า: 
				</p>
				<p style="padding-left: 34px;"><?php echo urldecode($vc->text); ?></p>
				<?php } ?>
			</div>
			
            <p>
				<textarea id="text<?php echo $v['id']; ?>" style="height: 30px; padding:0; margin:0;"></textarea> 
				<button style="height: 30px; padding:0 10px; margin:0;" onclick="sendComment('<?php echo CHtml::decode($v['id']); ?>', 'text<?php echo $v['id']; ?>', '<?php echo $v->users->id; ?>');"><?=Yii::t("app",'Send');?></button>
			</p>
			
        </div>
        
        <div style="clear: both;">
            <?php
			// satoo
			$satoo = Satoo::model()->findAllByAttributes(
				array(),
				$condition = 'node_id=:node_id',
				$params = array(':node_id'=>$v['id'])
			);
			
			$satoolist='';
			$satooOK=true;
			foreach ($satoo as $s) {
				$satoolist.= $s->users->firstname.' ';
				if ( $s->users->id == Yii::app()->user->id )
				{
					$satooOK=false;
				}
			}
			
			if($satooOK){
			?>			
				<span id="buttonsatoo<?php echo $v['id']; ?>" onclick="playSatoo(); doSatoo('<?php echo CHtml::decode($v['id']); ?>', '<?php echo Yii::app()->user->firstname; ?>');">
					<img src="<?php echo Yii::app()->baseUrl.'/images/satoo.png'; ?>" >
				</span>
			<?php } ?>
			
            <span id="spansatoo<?php echo $v['id']; ?>" >
			<?php                 
				echo $satoolist;
            ?> 
			<?php if(count($satoo)!=0) { ?>สาธุในสิ่งนี้<?php } ?>
			</span>
			
        </div>
    </div>
    <div style="border-bottom: 1px #fff solid; clear: both; margin-bottom: 5px; padding-bottom: 5px;"></div>

<?php } ?>
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("area[rel^='prettyPhoto']").prettyPhoto();
		
		$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
		$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

		$(".gallery3:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
		$(".gallery3:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
	});
</script>

<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#boon-post',
    'itemSelector' => 'div.boon-posts',
    'loadingText' => Yii::t("app",'Loading...'),
    'donetext' => Yii::t("app",'end of content'),
    'pages' => $pages,
)); ?>

