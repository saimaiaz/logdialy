
<?php 
	$v = $dataProvider;
?>    

<h1>Gallery - <?php echo urldecode($v['title']); ?></h1>

<div id="boon-post">
    
    <div style="box-sizing: border-box; " class="boon-posts">
		<div style="" id="profile">
			<p>

			<?php //print_r($v); exit;  ?>
				<img width="50" src="<?php echo Yii::app()->baseUrl.'/profilepicture/'.CHtml::decode($v->users->picture); ?>"> 
				
				 <?php echo CHtml::link($v->users->firstname, array('users/'.$v->users->id)); ?>
			</p>
			
		</div>
        <div style="float: left; padding-left: 52px;">
		
				<div class="gallery">
				[Gallery photo]<br>
					<?php 
					
					$gJson = json_decode($v['text'] );
					if(is_array($gJson)){
					foreach( $gJson as  $g )
					{
					?>
						<a  rel="prettyPhoto[gallery2]" href="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $g; ?>">
						<img width="150" src="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $g; ?>" /> 
						</a>
						<?php
					}}
					?>
					
					<?php if($v['picture']){ ?>	
					<div class="gallery">
						<a  rel="prettyPhoto[gallery2]" href="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $v['picture']; ?>">
						<img width="150" src="<?=Yii::app()->baseUrl; ?>/picture/<?php echo $v['picture']; ?>" /> 
						</a>
					</div>
					<?php } ?>
					
				</div>
			
			<div class="comment comment<?php echo $v['id']; ?>">
				<?php 
				foreach( $v->comment as $vc ){					
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
				<button style="height: 30px; padding:0 10px; margin:0;" onclick="sendComment('<?php echo CHtml::decode($v['id']); ?>', 'text<?php echo $v['id']; ?>', '<?php echo $v->users->id; ?>');"><?=Yii::t("app",'Send');?></button>
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

