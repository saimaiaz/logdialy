

<h1>แจ้งเตือน - ทามไลน์บุญ </h1>
<br />


<div id="boon-post">

<ul>
<?php 

function reverseDate($date) {
	if ( $date == '' ) return 0;
	
   $date = preg_split("[-]", $date);
   $date = $date[2]."-".$date[1]."-".$date[0];
   return $date;
}

function formatDate($a){	
	$a = substr($a, 0, 10);	
	return reverseDate($a);
}

foreach ($model as $k => $v) {    
	 // filter comment out
?>    
	<li>
	วันที่ : <?php  echo formatDate($v['date_create']) ?>  |
	หมวดหมู่ : <?php  echo $v->category->name ?> |
	<?php if( $v->category_id != 4 ) { echo 'หัวข้อ : '.$v['title'].' |'; } ?>	
	ข้อความ : 
	<?php 		
		if( $v->category_id == 2 || $v->category_id == 3 ){
			$j = json_decode( $v->text, true );
			echo $j['text'];
		}else if($v->category_id == 7){
			echo '[Gallery]';
		}else{
			echo urldecode($v->text); 
		}
	?>  
	
	</li>
<?php }
 ?>
	</ul>
</div>

