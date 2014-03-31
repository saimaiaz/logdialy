
<?php 
	$v = $dataProvider;	
?>    

<h3><?php echo Yii::t("app",'Profilepicture').' - '.urldecode($v->firstname); ?></h3>

<div id="boon-post">
    
    <div style="box-sizing: border-box; " class="boon-posts">
		<div style="" id="profile">			
			
		</div>
        <div style="float: left; padding-left: 52px;">
				<div class="gallery">
					
					<div class="gallery">
						<a  rel="prettyPhoto[gallery2]" href="<?=Yii::app()->baseUrl; ?>/profilepicture/<?php echo $v->picture; ?>">
						<img width="150" src="<?=Yii::app()->baseUrl; ?>/profilepicture/<?php echo $v->picture; ?>" /> 
						</a>
					</div>
					
				</div>
        </div>
        <br>
		
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

