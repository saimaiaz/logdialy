<?php
/* @var $this GroupsController */

$this->breadcrumbs=array(
	'Groups',
);

$v = $gmodel;
//echo gettype($v->name);
?>

<h2> <?php echo Yii::t("app",'Groups').' '.$v->name; //echo 'get p id '.$_GET['id'] ?></h2>

<?php if($v->picture){ ?>
<img src="<?php echo Yii::app()->baseUrl.'/picture/'.$v->picture; ?>" style="max-height: 200px; border: 1px solid #ddd; padding: 10px; margin: 10px 0; " /><?php } ?>

<p><?=Yii::t("app",'Groups name') ?> : <?php echo $v->name; ?> | <?php echo Yii::t("app",'Groups') ?> : <?php echo Yii::t("app", $v->privacy ); ?></p>
<p><?=Yii::t("app",'Groups detail') ?> : <?php echo $v->description; ?> </p>
<!--
<P><?=Yii::t("app",'request to join group') ?> : 

<input id="suggestfriend" type="hidden" />

<button onclick="" style="margin-top: -10px;"><?=Yii::t("app",'request to join group') ?></button>

</P>

<script>
	function doSuggestfriend(){		
		$.post( '<?php echo Yii::app()->createUrl('groups/addtogroup')?>' , 
		{user_id: $('#suggestfriend').val() , group_id: '<?=$_GET['id'] ?>' , YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken; ?>'} , 
		function(data) {
			console.log(data);
		});
	}
</script>
-->

<!--  post and comment start here  -->
