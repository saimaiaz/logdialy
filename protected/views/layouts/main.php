<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="th" lang="th">
<head>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<meta name="keyword" content="เก็บบุญ, ทำบุญ, บันทึกบุญ, ทำทาน, ปล่อยนก, บันทึกบุญกุศล">
	<meta name="description" content="เว็บไซต์สำหรับบันทึกความดี">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	
	<meta charset="utf-8" />
	<meta name="language" content="th" />

	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettyPhoto.css" />
		

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettify.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scrollPagination.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.prettyPhoto.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/socket.io.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-modal.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-dropdown.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/carosel.js"></script>

	<?php Yii::app()->clientScript->registerCoreScript('cookie');	?>
        
</head>

<body>

<!--[if lt IE 10]>
<![endif]-->

    <div class="container">
		
        <div class="row-fluid">
            <div class="span12 controll-menu">

                    <!-- <nav class="nav">
                    <ul>
                        <li class="current"><a href="#">profile</a></li>
                        <li><a href="#">setting</a></li>
                        <li><a href="#">friend</a></li>
                        <li><a href="#">logout</a></li>
                        <li><a href="#"><input type="text" id="search" value="search" ></a></li>
                    </ul>
                </nav>-->

                <div id="mainmenu">
				<div class="navbar navbar-inverse ">
                    <div class="navbar-inner">
					<div class="container-fluid">
					  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="brand" href="<?=Yii::app()->baseUrl ?>">LogDailyBoon</a>
					  <div class="nav-collapse collapse">
						<p class="navbar-text pull-right">
						<?php if( Yii::app()->user->isGuest ){ ?>
							<a href="<?=Yii::app()->baseUrl.'/site/login' ?>" class="navbar-link">Login</a>
						 <?php }else{ ?> 				
							Logged in as <a href="<?=Yii::app()->baseUrl.'/site/logout' ?>" class="navbar-link">Logout(<?=Yii::app()->user->firstname?>)</a>
						 <?php } ?> 
						</p>
						<ul class="nav">
						  <li class="active"><a href="#">Home</a></li>
						  <li><a href="<?=Yii::app()->baseUrl.'/site/about' ?>">About</a></li>
						</ul>
					  </div><!--/.nav-collapse -->
					</div>
				  </div>
				  </div>
                </div><!-- mainmenu -->
                
                <?php
//                    $this->widget('CStarRating',array(
//                        //'model'=>$model,
//                        //'attribute'=>'rating',
//                        'name'=>'rating1',
//                        'value'=>3,
//                    ));
//                    
//                    $this->widget('CMaskedTextField',array(
//                        //'model'=>$model,
//                        //'attribute'=>'date',
//                        'name'=>'date',
//                        'mask'=>'99.99.9999',
//                        'htmlOptions'=>array(
//                            'style'=>'width:80px;'
//                        ),
//                    ));

                ?>

            </div>
        </div>
		
        <div class="row-fluid">
            <div class="span12 header">
			
			<div  id="language-selector" style="float:right; margin:5px;">
				<?php 
					$this->widget('application.components.widgets.LanguageSelector');
				?>
			</div>
			
			<?php 
			// check variable login
			
			if( isset(Yii::app()->user->id) ){ 
			?>
				<img src="<?= Yii::app()->baseUrl.'/profilepicture/'.Yii::app()->user->picture; ?> " width="100" /> 
                notification : 
				<?php 				
				$model=Notify::model()->findAll(
					array(
						'order'=>'datetime_noti desc' , 
						'condition'=>':user_receive_id=user_receive_id' , 
						'params'=>array(':user_receive_id'=> Yii::app()->user->id )
					)
				);				
				$numnoti= count( $model );		
				
				$friendModel=Friend::model()->findAll(
					array(
						'condition'=>':to_id = to_id and status_id = 1 ' , 
						'params'=>array(':to_id'=> Yii::app()->user->id )
					)
				);
				
				
				?>
				<span id="notificationSummary"><?php echo $numnoti; ?></span>
				&nbsp;userid : <?= Yii::app()->user->id; ?> 
				&nbsp;firstname : <?= Yii::app()->user->firstname; ?> 
				&nbsp;permission : <?= Yii::app()->user->permission; ?> 
				
				<div><br>
				<?php 
				if ( Yii::app()->params['recordtodayboon'] == 0 )
				{
					echo '<a href="'.Yii::app()->baseUrl.'/nodes/recordboon">คุณยังไม่ได้บันทึกผลการปฏิบัติธรรม คลิกเพื่อบันทึก</a>';
				}
				?>
				
					<?php
						foreach( $friendModel as $v )
						{
							echo '<button onclick="acceptFriend('.$v->id
							.');"> ตอบรับการเป็นเพื่อนกับ '. $v->response_friend->firstname
							.'</button>';
						}
					?>
				</div>
				
				<!-- <div id="notification-bar"></div> -->
				<br>
				
				<script>
					/*
					$("#notification-bar").kendoPanelBar({
						dataSource: [
							{
								text: "การแจ้งเตือน ", imageUrl: "<?php echo Yii::app()->request->baseUrl; ?>/kendoui/examples/content/shared/icons/sports/baseball.png",
								items: [
								<?php 
								$i=0;
								foreach( $model as $v ){
								$i++;
								?>
								<?php if( $i != 1 ) echo ','; ?>{ text: "<?php echo str_replace("\n", '', $v->message); ?>", imageUrl: "<?php echo Yii::app()->request->baseUrl; ?>/kendoui/examples/content/shared/icons/16/star.png" }								
								<?php } ?>								
								]
							}
						]
					});
					*/
				</script>
				
				<?php } ?>
            </div>
        </div>
	
	  <div class="row-fluid left-bar">
	    <div class="span3 leftbar">
		
				<?php
						// for setting value in submenu
						// for display in sub satoo page and satoo group
						
						if( isset(Yii::app()->user->id) )
						{ 
						$userid = Yii::app()->user->id;

						
						$user = Users::model()->findByPk($userid);	
							
						$cate_list=array();
						$cate_list = array_merge( $cate_list ,explode(',', $user->satoo_pages ));		
						$cate_list = array_filter($cate_list);
						$criteria = new CDbCriteria;	
						$criteria->addInCondition('id', $cate_list ); 
						//$criteria->addCondition('subof = 5' ); 
						$satooPage = Category::model()->findAll( $criteria );
						
						$cate_list=array();
						$cate_list = array_merge( $cate_list ,explode(',', $user->member_groups ));	
						$cate_list = array_filter($cate_list);
						//$criteria->addCondition('subof = 6' ); 
						$criteria = new CDbCriteria;	
						$criteria->addInCondition('id', $cate_list ); 
						$satooGroup = Category::model()->findAll( $criteria );
						}
				?>
		
                <?php echo CHtml::link(Yii::t("app",'Nodes'), array('nodes/index') ); ?><br>
                <?php echo CHtml::link(Yii::t("app",'Users'), array('users/index') ); ?><br>                
                <?php echo CHtml::link(Yii::t("app",'Pages'), array('pages/index') ); ?><br>
				<!-- list of Pages -->
                <ul>
                    <?php if(isset($satooPage)){ foreach ($satooPage as $v){ ?>
                    <li><?php echo CHtml::link( Yii::t("app", $v->name) , array('pages/show/id/'.$v->id ) ); ?></li>
                    <?php }} ?>
                </ul>
                <?php echo CHtml::link(Yii::t("app",'Groups'), array('groups/index') ); ?><br>
				<!-- list of Groups -->
                <ul>
                    <?php if(isset($satooGroup)){ foreach ($satooGroup as $v){ ?>
                    <li><?php echo CHtml::link( Yii::t("app", $v->name) , array('groups/show/id/'.$v->id ) ); ?></li>
                    <?php }} ?>
                </ul>
                <?php echo CHtml::link(Yii::t("app",'Suggest friend'), array('suggestfirend/index') ); ?><br>
                <?php echo Yii::t("app",'Category'); //CHtml::link(Yii::t("app",'Category'), array('category/index') ); ?><br>
				<!-- list of category -->
                <ul>
                    <?php foreach (Category::model()->findAll( array('condition'=>'is_show=1') ) as $v){ ?>
                    <li><?php echo CHtml::link( Yii::t("app", $v->name) , array('nodes/'.$v->link ) ); ?></li>
                    <?php } ?>
                </ul>
                    
	      <!--Sidebar content-->
	    </div>
	    <div class="span9 content">
                <?php echo $content; ?>
                <div class="clear"></div>
	      <!--Body content-->
	    </div>
	  </div>	
            <div class="row-fluid">
                <div class="span12 footer">
                    
					<div id="footer">
						<div class="container">
							<p class="muted credit">
								&copy; LogDailyBoon by Tconnet co. ltd, <?=date("Y") ?>  Powerd by <a href="http://www.tconnet.co.th" >tconnet</a>
							</p>
						</div>
					</div>
					
                </div>
            </div>	
	</div>
	
<audio style='display: none;' id='audio1' src='<?php echo Yii::app()->baseUrl.'/sound/'; ?>satoo.mp3' controls preload='auto' autobuffer>
</audio>
    
	
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-525b703c6e599ca4"></script>	
<script>

var socket = io.connect('http://122.155.1.249:4001');



function checkUpdateComment(){
	$.post( '<?php echo Yii::app()->baseUrl; ?>/nodes/checkUpdateComment' , 
		{timeupdate: '<?=time(); ?>' , YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>' } ,
		function(data){
			if ( $.cookie('noticount') != parseInt( $("#notificationSummary").text() ) )
			{
				eval( data );
			}		
		}
	);
}




function acceptFriend(id){
	$.post( '<?php echo Yii::app()->baseUrl; ?>/users/acceptfriend' , 
		{friend_id: id , YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken; ?>' } ,
		function(data){
			alert('เพิ่มเป็นเพื่อนแล้ว');
			location.href=location.href;
		}
	);
}


function playSatoo(){
	document.getElementById('audio1').play();
}

<?php
$getid = isset($_GET['id'])?$_GET['id']:0;
?>
function doSatooPage(){
    $(function(){
        $.get('<?php  echo Yii::app()->baseUrl.'/nodes/dosatoopage/nodeid/'.$getid; ?>' , function(data) {
			console.log( data );
        });
    });
}

function doSatoo(nodeid, name){
    $(function(){
        $.get('<?php echo Yii::app()->baseUrl.'/nodes/dosatoo?nodeid='; ?>'+nodeid , function(data) {
			console.log( data );
        });
    });
	
	var s = $("#spansatoo"+nodeid);
	if ( s.text().trim()=="" )
	{
		s.text(name+' สาธุในสิ่งนี้');
	}else{
		s.text(name+' '+s.text());
	}
	
	//
	$('#buttonsatoo'+nodeid).hide();
	
}


function sendComment(nodeid, textid, owner){
	
	if ( $('#'+textid).val().trim()=='' )
	{
		return;
	}
	
	$.post( '<?php echo Yii::app()->baseUrl.'/nodes/comment'; ?>' , 
	{ nodeid: nodeid, text: $('#'+textid).val(), nodeowner: owner, YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>' } , 
	function(data) {
	
		$('.comment'+nodeid).append(
		'<p>'+
			'<img width="30" src="<?php if( isset(Yii::app()->user->picture) ){ echo Yii::app()->baseUrl.'/profilepicture/'.Yii::app()->user->picture; ?>" /> '+
			'<?php echo Yii::app()->user->firstname; } ?> พูดว่า: '+
		'</p>'+
		'<p style="padding-left: 34px;">'+$('#'+textid).val()+'</p>'
		);
		
		// clear value textarea
		$('#'+textid).val('');
		
		//console.log(data);
	});
	
	var msg = {};
	msg.nodeid= nodeid;
	msg.text= $('#'+textid).val();
	msg.owner= owner;
	msg.picture= '<?php if( isset(Yii::app()->user->picture) ){ echo Yii::app()->baseUrl.'/profilepicture/'.Yii::app()->user->picture;} ?>';
	msg.firstname = '<?php if( isset(Yii::app()->user->firstname) ){ echo Yii::app()->user->firstname; } ?>';
		
	socket.emit('msg', msg );
}

socket.on('msg1', function(data) {
	//console.log(data);
	
	$('.comment'+data.nodeid).append(
		'<p>'+
			'<img width="30" src="'+data.picture+'" /> '+
			data.firstname+' พูดว่า: '+
		'</p>'+
		'<p style="padding-left: 34px;">'+data.text+'</p>'
	);
	
});

socket.on('init', function(data) {
	//console.log(data);
});

function hide(id)
{
	$.post( '<?php echo Yii::app()->baseUrl.'/nodes/hide'; ?>' , 
	{ nodeid: id, YII_CSRF_TOKEN:'<?php echo Yii::app()->request->csrfToken; ?>' } , 
	function(data) {
		console.log( data );
	});
	
}

// addthis panel
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    },  
    'whatsnext' : {},  
    'recommended' : {} 
  });

</script>


</body>
</html>
