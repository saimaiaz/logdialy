

<a  target="_BLANK" rel="prettyPhoto[gallery2]" href="<?=Yii::app()->createUrl('gallery/showprofilepicture/', array('id'=>$model->id) ); ?>">
<img width="150" src="<?=Yii::app()->baseUrl; ?>/profilepicture/<?php echo $model->picture; ?>" /> 
</a>	
<h3>View user <?php echo $model->firstname; ?> <?php echo $model->lastname; ?></h3>

<p>
<?php 
	if(Yii::app()->user->id != $model->id) { 
	
	/*
	Person::model()->findByAttributes(
    array('first_name'=>$firstName,'last_name'=>$lastName),
		'status=:status',
		array(':status'=>1)
	);	
	*/
	
	$isFriend = count(Friend::model()->findByAttributes(array('from_id'=>Yii::app()->user->id, 'to_id'=>$model->id)));

		if ( $isFriend ) //$isFriend
		{
			echo Yii::t("app",'Friended');
		}else{
?> 		
		<a href="<?php echo Yii::app()->baseUrl; ?>/users/addfriend/<?php echo $model->id; ?>" ><?= Yii::t("app",'Add to friend');?></a> 
		
<?php
		}// $isFriend
	} // if(Yii::app()->user->id != $model->id) { 
 
 else {
 ?> 

โปรไฟล์ของคุณ <?php }?>

</p>

</br>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'firstname',
        'lastname',
        'username',
        'age',
        'sex',
        'address',
        'email',
        'telephone',
    //    'permission',
		
/*
        array(
            'label' => 'profile picture',
            'type' => 'raw',
            //'value' => html_entity_decode(CHtml::image(Yii::app()->baseUrl . '/profilepicture/'.
            //        $model->picture ,'alt',array('width'=>100,'height'=>100))),
            'value' => html_entity_decode(),
        ), 
*/
        'group_id',
    ),
));
?>

<br>
<br>










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

