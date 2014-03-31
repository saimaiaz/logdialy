<?php

class NodesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
	private $pagesize = 2;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(

            array('allow', // allow all users to perform 'index' and 'view' actions
            //    'actions' => array('index', 'view', 'create', 'update', 'comment', 'do' ),
                'users' => array('@'),
            ),

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),    
			
           // กำหนดเพื่อให้ ต้องล๊อกอินก่อนเข้าหน้าเหล่านี้
			array('deny',  // deny all anonymous
				'actions' => array('index', 'view', 'create', 'update', 'comment', 'do', 'activity_boon', 'recordboon', 'dhamma', 'hide' ),
				'users'=>array('*'),
			),
         
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Nodes;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nodes'])) {
            $model->attributes = $_POST['Nodes'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Nodes'])) {
            $model->attributes = $_POST['Nodes'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
	 
	 // perform insert to db
	private function insertToDb($model){
		
		if ( isset($_POST['Nodes']) || isset($_POST['Activity']) || isset($_POST['Dhamma']) ) {
            
			if(isset($_POST['Nodes']))
			{
				$model->attributes=$_POST['Nodes'];
				$p=$_POST['Nodes'];
			}
			if(isset($_POST['Activity']))
			{
				$model->attributes=$_POST['Activity'];
				$p=$_POST['Activity'];
			}
			if(isset($_POST['Dhamma']))
			{
				$model->attributes=$_POST['Dhamma'];
				$p=$_POST['Dhamma'];
			}
			
			// for implement extend field
				// for activity
				if( $model->category_id== 2 )
				{
					$a['text'] = $model->text;
					$a['location'] = $model->location;
					$model->text = json_encode($a);
				}
				
				// for dhamma
				if( $model->category_id== 3 )
				{
					$a['text'] = $model->text;
					$a['samma'] = $model->samma;
					$a['time_samati'] = $model->time_samati;
					$a['goodness'] = $model->goodness;
					$model->text = json_encode($a);
				}
			
            $model->date_create = $this->reverseDate($p['date_update']); 
            $model->date_update =date("Y-m-d H:i:s");
            $model->parent_id = 0; 
            $model->user_id = Yii::app()->user->id ;
            $model->category_id = $p['category_id'];
            
			$filename='';
            $m = CUploadedFile::getInstance($model,'picture');
            if ($m) { // avoid empty picture upload
				$rnd = rand(0,9999).time();
                $filename = $rnd.'.'.$m->extensionName;
                $model->picture = $filename;
            }
            
            if ( $model->save() ) {    
                if ($m) { // avoid empty picture upload
                    $images_path = realpath(Yii::app()->basePath.'/../picture');
                    $m->saveAs($images_path.'/'.$filename);
                }
				
                $this->redirect( $_SERVER['HTTP_REFERER'] );
            }
        }
		
	}
	
	
	 //Yii::trace(Yii::app()->user->id.','.Yii::app()->user->friendlist,'test');
    public function actionIndex() {
		
        $model = new Nodes();
		
        $this->insertToDb($model);		
		
        $criteria = new CDbCriteria;	
		$criteria->order = 'id desc';
		$uid = unserialize( Yii::app()->user->friendlist );
		// add myself to friend list
		$uid[] = (int)Yii::app()->user->id;
		$criteria->addInCondition('user_id', $uid );
		
		// 123 is บันทึกผลการปฎิบัติธรรม กิจกรรมบุญ ธรรมะและข้อคิด 
		// 7 gallery
		$cate_list = array(1, 2, 3, 7);
		
		$user = Users::model()->findByPk(Yii::app()->user->id);		
		// add member_groups to timeline 
		$cate_list = array_merge( $cate_list ,explode(',', $user->member_groups ));		
		// add satoo_pages to timeline 
		$cate_list = array_merge( $cate_list ,explode(',', $user->satoo_pages ));		
		$cate_list = array_filter($cate_list);
		
		//print_r( $cate_list ); exit;
		
		$criteria->addInCondition('category_id', $cate_list ); 
		$criteria->addNotInCondition('hide', array(1) ); 
		$total = Nodes::model()->count();
		$pages = new CPagination($total);
		$pages->pageSize = $this->pagesize;
		$pages->applyLimit($criteria);
		
		$dataProvider = Nodes::model()->findAll( $criteria );
		
			
			
        $this->render('index', array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
			'pages'=>$pages,
        ));
        
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Nodes('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Nodes']))
            $model->attributes = $_GET['Nodes'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Nodes the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Nodes::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Nodes $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'nodes-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionDosatoo($nodeid){
        //echo $nodeid; exit;
        $satoo = new Satoo;
        $satoo->node_id = $nodeid;
        $satoo->user_id = Yii::app()->user->id;
        
//        echo 'nodeid:'.$satoo->node_id.'<br>';
//        echo 'user_id:'.$satoo->user_id.'<br>';
        
        if ($satoo->save()) {
            echo 'saved';
        }else{
            echo 'error ';            
        }
        
    }
	
	public function actionDosatoopage($nodeid){
		
		$model = Users::model()->findByPk((int) Yii::app()->user->id );
		if ( $model->satoo_pages =='' )
		{
			$model->satoo_pages = (int) $nodeid;
		}else{
			$model->satoo_pages .= ','. (int) $nodeid;
		}
		
        if ($model->save()) {
            echo 'satoo page ok';
        }else{
            echo 'error ';            
        }
        
    }
    
    public function actionDo(){ 
		$this->render('msg', array('data'=>'sdfdsf')); 
	}
    
    public function actionComment(){
    	if ( $_POST ){
			$node = new Nodes;
			$node->parent_id = (int)$_POST['nodeid'];
			$node->text = urlencode($_POST['text']);
			$node->date_create = date("Y-m-d H:i:s");
			$node->date_update = date("Y-m-d H:i:s");
			$node->title='-';
			$node->user_id=Yii::app()->user->id;
			$node->category_id=4; // Category::model->findById(4);
			//echo $node->title; exit;
			
			$notify = new Notify;
			$notify->message = $_POST['text'];
			$notify->node_id = (int)$_POST['nodeid'];
			$notify->user_receive_id = (int)$_POST['nodeowner'];
			$notify->user_send_id = (int)Yii::app()->user->id;
			$notify->type_id = 0;
			$notify->Isreaded = 0;
			$notify->datetime_noti = date( 'Y-m-d H:i:s', time() );
			
			/*$notify->save() ;
			print_r($notify->getErrors());
			exit;*/
			
			if( $node->save() && $notify->save() ){
				//$this->render('msg', array('data'=>'saved')); 
				echo 'saved';
			}else{				
				//$this->render('msg', array('data'=>'error')); 
				echo 'error';
			}
		}   	
    }
	
	public function actionTest(){
		echo 'test';
	}
	
	public function actionCheckUpdateComment(){
		
	Yii::app()->clientScript->registerCoreScript('cookie');		
		
	//	if ( $_POST ){		
		$model=Notify::model()->findAll(
			array(
				'order'=>'datetime_noti asc' ,
				'condition'=>':user_receive_id=user_receive_id' ,
				'params'=>array(':user_receive_id' => Yii::app()->user->id )
			)
		);
		
		//print_r($model); exit;			
		$this->renderPartial('_msg', array('model'=> $model));
	//	}
		
	}
	
	public function actionRecordboon(){
		//$this->render('recordboon');
		
		$model = new Nodes();
		
		$this->insertToDb($model);
		
		$this->insertToDb($model);		
		$criteria = new CDbCriteria;	
		$criteria->order = 'id desc';
		$uid = unserialize( Yii::app()->user->friendlist );
		// add myself to friend list
		$uid[] = (int)Yii::app()->user->id;
		$criteria->addInCondition('user_id', $uid );
		$criteria->addInCondition('category_id', array(1) ); // 123 is category for show
		
		$total = Nodes::model()->count(); 
		$pages = new CPagination($total);
		$pages->pageSize = $this->pagesize;
		$pages->applyLimit($criteria);
		
		$dataProvider = Nodes::model()->findAll( $criteria );
		
        $this->render('recordboon', array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
			'pages'=>$pages,
        ));
	}
	
	public function actionActivity_boon(){

		$model = new Activity();
		
		$this->insertToDb($model);
		
		$criteria = new CDbCriteria;	
		$criteria->order = 'id desc';
		$uid = unserialize( Yii::app()->user->friendlist );
		// add myself to friend list
		$uid[] = (int)Yii::app()->user->id;
		$criteria->addInCondition('user_id', $uid );
		$criteria->addInCondition('category_id', array(2) ); // 123 is category for show
		
		$total = Nodes::model()->count(); 
		$pages = new CPagination($total);
		$pages->pageSize = $this->pagesize;
		$pages->applyLimit($criteria);
		
		$dataProvider = Nodes::model()->findAll( $criteria );
	
		$this->render('activity_boon', array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
			'pages'=>$pages,
        ));
	}
	
	public function actionDhamma(){
	
		$model = new Dhamma();
		
		$this->insertToDb($model);		
		
		$criteria = new CDbCriteria;	
		$criteria->order = 'id desc';
		$uid = unserialize( Yii::app()->user->friendlist );
		// add myself to friend list
		$uid[] = (int)Yii::app()->user->id;
		$criteria->addInCondition('user_id', $uid );
		$criteria->addInCondition('category_id', array(3) ); // 123 is category for show
		
		$total = Nodes::model()->count(); 
		$pages = new CPagination($total);
		$pages->pageSize = $this->pagesize;
		$pages->applyLimit($criteria);
		
		$dataProvider = Nodes::model()->findAll( $criteria );
		
        $this->render('dhamma', array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
			'pages'=>$pages,
        ));
	
	}
	
	private function reverseDate($date) {
		if ( $date == '' ) return 0;
		
	   $date = preg_split("[/]", $date);
	   $date = $date[2]."-".$date[1]."-".$date[0];
	   return $date;
	}
	
	public function actionAjaxLazyContent(){
		
		if ( ! $_POST ){  echo 'Bad request.'; exit; }
		
		//$this->renderPartial('_msg', array('model'=> $model));
	}
	
	public function actionNotification(){

		$model = Nodes::model()->findAllByAttributes(
			array(
			'user_id'=>Yii::app()->user->id,
			)
		);
		//print_r($model);		exit;
		//echo count($model);		exit;
		
		$this->render('notification', array(
			'model'=>$model,
		) );
	}
	
	public function actionNotificationreport(){
		
	}
	
	public function actionHide(){
		
		if ( ! isset($_POST['nodeid'] )) exit;
		//else echo $_POST['nodeid']; exit;
		
		$model = Nodes::model()->findByPk($_POST['nodeid']);
		$model->hide = 1;
		$model->save();
		
	}

}
