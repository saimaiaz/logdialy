<?php

class GalleryController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionShow($id){
		//print_r($dataProvider); exit;
		
		$this->render('show', array('dataProvider'=> Nodes::model()->findByPk($id)));
	}
	
	public function actionShowprofilepicture($id){
		$this->render('showprofilepicture', array('dataProvider'=> Users::model()->findByPk($id)));
	}

	public function actionCreate(){
		
		$model = new Gallery2();
		
		if (isset($_POST['Gallery2'])) {
		
            $model->attributes=$_POST['Gallery2'];
            $model->title = $_POST['Gallery2']['title'];
			
			$files=array();
			$fdata=$_FILES['picture']; 
			if(is_array($fdata['name'])){
			for($i=0;$i<count($fdata['name']);++$i){
					$files[]=array(
				'name'    =>$fdata['name'][$i],
				'type'  => $fdata['type'][$i],
				'tmp_name'=>$fdata['tmp_name'][$i],
				'error' => $fdata['error'][$i], 
				'size'  => $fdata['size'][$i]  
				);
				}
			}else $files[]=$fdata;
			$fileName =array();
			$fileTmp =array();
			foreach ($files as $file) { 
				//echo $file['name'].'<br>';
				$rnd = rand(0,9999).time();
				$fileName[] =  $rnd.$file['name'];
				$fileTmp[] = $file['tmp_name'];
			}
			//echo realpath(Yii::app()->basePath.'/../picture/');
			//print_r($fileName);
			//print_r($fileTmp);			
			//exit;
			
            $model->text = 	json_encode($fileName);
            $model->date_create = $this->reverseDate($_POST['Gallery2']['date_update']); 
            $model->date_update =date("Y-m-d H:i:s");
            $model->parent_id = 0; 
            $model->user_id = Yii::app()->user->id;
            $model->category_id = $_POST['Gallery2']['category_id'];            
            
            if ( $model->save() ) {    
                if (!empty($fileName)) { // avoid empty picture upload
                    foreach( $fileName as $k=>$v ){
						$images_path = realpath(Yii::app()->basePath.'/../picture/');
						move_uploaded_file($fileTmp[$k], $images_path.'/'.$fileName[$k]);
					}
                }
				
                $this->redirect( $_SERVER['HTTP_REFERER'] );
            }
        }
		
		$this->render('create', array('model'=>$model) );
	}
	
	
	
	private function reverseDate($date) {
		if ( $date == '' ) return 0;
		
	   $date = preg_split("[/]", $date);
	   $date = $date[2]."-".$date[1]."-".$date[0];
	   return $date;
	}
	
}