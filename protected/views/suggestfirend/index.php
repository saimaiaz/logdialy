<?php
/* @var $this SuggestfirendController */

$this->breadcrumbs=array(
	'Suggestfirend',
);
?>
<h1>
<?php  
	//echo $this->id . '/' . $this->action->id; 	
	echo Yii::t("app",'Suggestfirend');
?>
</h1>

<table border="0">
	<tr><th style="width: 100px;"><?= Yii::t("app",'Chanel');?></th><th><?= Yii::t("app",'Send');?></th></tr>
	<tr><td><?= Yii::t("app",'Email');?></td>
		<td>
			<form method="post">
			<input type="hidden" name="YII_CSRF_TOKEN" value="<?=Yii::app()->request->csrfToken; ?>" />
			<input style="margin-top: 10px;" type="text" name="email" /> 
			<input type="submit" name="submit" value="<?= Yii::t("app",'send email to friend');?>" />
			</form>
		</td>
	</tr>
	<tr>
		<td><?= Yii::t("app",'Share Facebook');?></td>
		<td>
			<a href="#" 
			  onclick="
				window.open(
				  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
				  'facebook-share-dialog', 
				  'width=626,height=436'); 
				return false;">
			  <img src="<?php echo Yii::app()->baseUrl; ?>/images/share_on_face.png" />
			</a>
		</td>
	</tr>
</table>