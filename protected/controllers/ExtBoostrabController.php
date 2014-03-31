<?php

class ExtBoostrabController extends Controller {

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
       // $dataProvider = new CActiveDataProvider('Users');
		// init for gridview
		$gridDataProvider = new CArrayDataProvider(array(
			array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'CSS'),
			array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'JavaScript'),
			array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'HTML'),
		));
	//	echo print_r($gridDataProvider); exit;
		$model = new Users;
		
        $this->render('index'
			,array( 'gridDataProvider' => $gridDataProvider, 'model'=>$model ) 
		);
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
	
	

}
