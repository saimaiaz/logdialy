<?php

class PagesController extends Controller
{
	
	private $pagesize = 2;
	
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
                'actions' => array('view', 'autocomplete',  'test', 'testpdf'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'index','admin', 'show', ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
	
	
	public function actionIndex()
	{
		$model = Category::model()->findAll(
			'subof=:subof', array(':subof'=>5) // 5 = pages
		);
		
		$this->render('index', array(
			'model'=>$model,
		));
	}
	
	public function actionCreate()
	{
		$model = new Pages;
	
		// check input
		if (isset($_POST['Pages']))
        {
			$model->attributes = $_POST['Pages'];
			$model->subof = 5; // 5=page
			$model->owner_id = Yii::app()->user->id;
			
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
                $this->redirect( array('pages/show', 'id'=>$model->primaryKey ) );
            }
		}
		
		$this->render('create_page', array( 'model'=>$model ) );
	}
	
	
	public function actionShow($id)
	{
		$gmodel = Groups::model()->findByPk($id);
		$user = Users::model()->findByPk(Yii::app()->user->id);
		$page_of_user = explode( ',', $user->satoo_pages );
		//$cate = Category::model()->findByPk($id);
		
		$user_satoo_this_page = FALSE;
		if (in_array($id, $page_of_user ))
		{
			$user_satoo_this_page = TRUE;
		}
			
			$nmodel = new Nodes;			
			$this->insertToDb($nmodel);
			
			$criteria = new CDbCriteria;	
			$criteria->order = 'id desc';
			//$uid = unserialize( Yii::app()->user->friendlist );
			// add myself to friend list
			$uid[] = (int)Yii::app()->user->id;
			//$criteria->addInCondition('user_id', $uid );
			$criteria->addInCondition('category_id', array( $_GET['id'] ) ); // 123 is category for show
			
			$total = Nodes::model()->count();
			$pages = new CPagination($total);
			$pages->pageSize = $this->pagesize;
			$pages->applyLimit($criteria);
			
			$dataProvider = Nodes::model()->findAll( $criteria );
				
			$this->render('show', array( 
				'gmodel'=>$gmodel ,
				'nmodel'=>$nmodel ,
				'dataProvider'=>$dataProvider ,
				'pages'=>$pages ,
				'user_satoo_this_page'=>$user_satoo_this_page ,
				)
			);
	}
	
	// perform insert to db
	private function insertToDb($model){
		
		if (isset($_POST['Nodes'])) {
            
            $model->attributes=$_POST['Nodes'];
            $model->title = $_POST['Nodes']['title'];
            $model->text = $_POST['Nodes']['text'];
            $model->date_create = $this->reverseDate($_POST['Nodes']['date_update']); 
            $model->date_update =date("Y-m-d H:i:s");
            $model->parent_id = 0; 
            $model->user_id = Yii::app()->user->id ;
            $model->category_id = $_POST['Nodes']['category_id'];
            
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
	
	private function reverseDate($date) {
		if ( $date == '' ) return 0;
		
	   $date = preg_split("[/]", $date);
	   $date = $date[2]."-".$date[1]."-".$date[0];
	   return $date;
	}
	
	public function actionTestpdf(){
	ini_set('memory_limit', '200M');
	
	//echo ini_get('memory_limit');
	//exit;
	
		# mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('utf-8', 'A4');
 
        # render (full page)
        //$mPDF1->WriteHTML($this->render('testpdf', array(), true));
 
        # Load a stylesheet
       // $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
      //  $mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
		
		$mPDF1->SetAutoFont();
        $mPDF1->WriteHTML($this->renderPartial('testpdf', array(), true));
         
        # Renders image
    //    $mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
	}
}