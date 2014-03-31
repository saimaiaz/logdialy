<?php

class UsersController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
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
                'actions' => array( 'view', 'create', 'register'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index','admin', 'delete', 'update', 'showprofile', 'addfriend', 'acceptfriend', 'edit', 'changepassword', 'test' ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
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
        $model = new Users;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $rnd = rand(0, 9999) . time();
            $model->attributes = $_POST['Users'];
            $model->password = md5($_POST['Users']['password']);
            
            $m = CUploadedFile::getInstance($model, 'picture');
            if ($m) { // avoid empty picture upload
                $filename = 'profilepic'.$rnd.'.'.$m->extensionName;
                $model->picture = $filename;
            }
            
            if ($model->save())
            {
                if ($m) { // avoid empty picture upload
                    $images_path = realpath(Yii::app()->basePath.'/../profilepicture');
                    $m->saveAs($images_path.'/'.$filename);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
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

        if (isset($_POST['Users'])) {
            $rnd = rand(0, 9999) . time();
            $model->attributes = $_POST['Users'];        
            
            $m = CUploadedFile::getInstance($model, 'picture');
            if ($m) { // avoid empty picture upload
                $filename = 'profilepic'.$rnd.'.'.$m->extensionName;
                $model->picture = $filename;
            }
            
            if ($model->save()){
                if ($m) { // avoid empty picture upload
                    $images_path = realpath(Yii::app()->basePath.'/../profilepicture');
                    $m->saveAs($images_path.'/'.$filename);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
		// clear password before display
		$model->password = '';
			
        $this->render('update', array(
            'model' => $model,
        ));
    }
	
	
	public function actionEdit($id) {
        $model = $this->loadModel($id);
		
        if (isset($_POST['Users'])){			
            $rnd = rand(0, 9999) . time();
			$oldpassmd5 = $model->password;
            $model->attributes = $_POST['Users'];            
            $m = CUploadedFile::getInstance($model, 'picture');
            if ($m) { // avoid empty picture upload
                $filename = 'profilepic'.$rnd.'.'.$m->extensionName;
                $model->picture = $filename;
            }
            
            if ($model->save()){
                if ($m) { // avoid empty picture upload
                    $images_path = realpath(Yii::app()->basePath.'/../profilepicture');
                    $m->saveAs($images_path.'/'.$filename);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }		
		$model->password = '';
			
        $this->render('_form_edit', array(
            'model' => $model,
        ));
		
		Yii::app()->user->setFlash('passChangeError', 'Your password was not changed because it did not matched the <strong>old password</strong>.');  
		
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Users');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Users('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Users::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
	
	public function actionShowprofile($id){
		$this->layout = '//layouts/column1';
		
		$criteria = new CDbCriteria;	
		$criteria->order = 'id desc';
		$uid=array();
		$uid[] = $id;

		$criteria->addInCondition('user_id', $uid );
		
		// 123 is บันทึกผลการปฎิบัติธรรม กิจกรรมบุญ ธรรมะและข้อคิด 
		// 7 gallery
		$cate_list = array(1,2,3);
		
		$criteria->addInCondition('category_id', $cate_list ); 
		$total = Nodes::model()->count();
		$pages = new CPagination($total);
		$pages->pageSize = $this->pagesize;
		$pages->applyLimit($criteria);
		
		$dataProvider = Nodes::model()->findAll( $criteria );
		
		$this->render('viewprofile', array(
            'model' => $this->loadModel($id),
            'dataProvider' => $dataProvider,
			'pages' => $pages
        ));
	}
	
	public function actionAddfriend($id){
		
		$found = Friend::model()->findAll(
			array(
				'condition'=>':from_id=from_id and :to_id=to_id' ,
				'params'=>array(
					':from_id' => Yii::app()->user->id ,
					':to_id' => $id
				)
			)
		);
		
		if ( count($found)==0 )
		{
			$model = new Friend;
			$model->from_id = Yii::app()->user->id;
			$model->to_id = $id;
			$model->status_id = 1;
			$model->send_date = date("Y-m-d H:i:s");
			$model->accept_date = 0;
			
			
			$notify = new Notify;
			$notify->message = 'ผู้ใช้ชื่อ '.Yii::app()->user->firstname.' ต้องการขอเป็นเพื่อนกับคุณ ';
			$notify->node_id = 0;
			$notify->user_receive_id = (int)$id;
			$notify->user_send_id = (int)Yii::app()->user->id;
			$notify->type_id = 0;
			$notify->Isreaded = 0;
			$notify->datetime_noti = date( 'Y-m-d H:i:s', time() );
			
			if( $model->save() && $notify->save() )
			{
				$this->renderPartial('_msg', array('data'=>"<script> alert('เพิ่มเพื่อนแล้ว'); history.back();</script>"));
			}else{
				$this->renderPartial('_msg', array('data'=>'error', 'error'=>$model->getErrors() ));
			}
			
		}else
			$this->renderPartial('_msg', array('data'=>"<script> alert('คุณได้กดเพิ่มเพื่อนแล้วรอการยืนยัน'); history.back();</script>"));
		
	}
	
	public function actionRegister(){
	
	$model = new Users;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Users'])) {
            $rnd = rand(0, 9999) . time();
            $model->attributes = $_POST['Users'];
            $model->password = md5($_POST['Users']['password']);
   //         $model->confirm_password = md5($_POST['Users']['confirm_password']);

            $m = CUploadedFile::getInstance($model, 'picture');
            if ($m) { // avoid empty picture upload
                $filename = 'profilepic'.$rnd.'.'.$m->extensionName;
                $model->picture = $filename;
            }
            
            if ($model->save())
            {
                if ($m) { // avoid empty picture upload
                    $images_path = realpath(Yii::app()->basePath.'/../profilepicture');
                    $m->saveAs($images_path.'/'.$filename);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
		
		//if(!$model->validate()){ // or !$model->save() depending on what do you want to do
			$model->password = '';
			$model->confirm_password = '';
		//}

        $this->render('register', array(
            'model' => $model,
        ));
	
	
		//$this->render('register');
	}
	
	public function actionChangepassword($id)
    {  
		$user = ChangePass::model()->findByPk($id);
		
		if (isset($_POST['ChangePass'])) { 
		
			//print_r($_POST['ChangePass']); 
			//echo 'old pass '. $user->password.' new pass '.md5($_POST['ChangePass']['old_password']);			
			//exit;
			
			if ( $_POST['ChangePass']['password'] !== $_POST['ChangePass']['confirm_password'] )
			{
				$user->addError('password', 'password and confirm_password are not match');
			}
			else if( md5($_POST['ChangePass']['old_password']) !== $user->password  )
			{			
			   $user->addError('password', 'oldpassword not match');
			}else{				
			//   $user->setScenario('changePassword');
			   $user->attributes = $_POST['ChangePass'];
			   $user->password = md5($_POST['ChangePass']['password']);
			   if( $user->save() ){
					Yii::app()->user->setFlash('success', Yii::t("app",'Password has been changed.'));
			   }
			}
		}
		
		$user->password='';
		
		$this->render('_form_changepassword', array(
            'model' => $user,
        ));
		
	}
		
	public function actionAcceptfriend(){
		$model = Friend::model()->findByPk( (int) $_POST['friend_id']  );
		
		$model->status_id = 2;
		$model->accept_date = date( 'Y-m-d H:i:s', time() );
		
		// add new friend to the list of friend
		$friendlist = unserialize(Yii::app()->user->friendlist);
		$friendlist[] = $model->from_id;
		Yii::app()->user->friendlist = serialize($friendlist);
		
		// do notify here		
		$umodel = Users::model()->findByPk($model->to_id);
		
		$notify = new Notify;
		$notify->message = 'ผู้ใช้ชื่อ '.$umodel->firstname.' เป็นเพื่อนกับคุณแล้ว ';
		$notify->node_id = 0;
		$notify->user_receive_id = $model->from_id;
		$notify->user_send_id = $model->to_id;
		$notify->type_id = 0;
		$notify->Isreaded = 0;
		$notify->datetime_noti = date( 'Y-m-d H:i:s', time() );
		
		if($model->save() && $notify->save() )
		{
			echo 'ok';
		}
	}
	
	public function actionTest(){
		$friendlist = unserialize(Yii::app()->user->friendlist);		
		print_r($friendlist);
	}

}
