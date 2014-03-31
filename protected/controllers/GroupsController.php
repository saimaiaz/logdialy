<?php

class GroupsController extends Controller
{

	public $layout = '//layouts/column1';
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
                'actions' => array('view',  'autocomplete', 'addtogroup', 'test'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create','index','admin', 'show', ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
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
	
	public function actionIndex()
	{		
		$model = Category::model()->findAll(
			'subof=:subof', array(':subof'=>6) // 6 is groups
		);
		
		$this->render('index', array(
			'model'=>$model,
		));
	}
	
	public function actionShow($id)
	{
		$gmodel = Groups::model()->findByPk($id);
		$user = Users::model()->findByPk(Yii::app()->user->id);
		$group_of_user = explode( ',', $user->member_groups );
		$cate = Category::model()->findByPk($id);		
		
		if ( $gmodel->privacy == 'Secret' && $cate->owner_id != Yii::app()->user->id )
		{
			if (! in_array($id, $group_of_user ))
			{
				throw new CHttpException(404,'Error page not found.');
				Yii::app()->end();
			}
		}else if( $gmodel->privacy == 'Private' && $cate->owner_id != Yii::app()->user->id ){
			if (! in_array($id, $group_of_user ))
			{
				$this->render('showEntranceGroup', array('gmodel'=>$gmodel) );
				Yii::app()->end();
			}
		}
			
			$nmodel = new Nodes;
			
			$this->insertToDb($nmodel);
			
			$criteria = new CDbCriteria;	
			$criteria->order = 'id desc';
			//$uid = unserialize( Yii::app()->user->friendlist );
			// add myself to friend list
			//$uid[] = (int)Yii::app()->user->id;
			//$criteria->addInCondition('user_id', $uid );
			$criteria->addInCondition('category_id', array( $_GET['id'] ) ); // 123 is category for show
			
			$total = Nodes::model()->count();
			$pages = new CPagination($total);
			$pages->pageSize = $this->pagesize;
			$pages->applyLimit($criteria);
			
			$dataProvider = Nodes::model()->findAll( $criteria );
				
			$this->render('show', array( 
				'gmodel'=>$gmodel ,
				'nmodel'=>$nmodel,
				'dataProvider'=>$dataProvider,
				'pages'=>$pages, )
			);
	}
	
	
	
	public function actionCreate(){
		
		$model = new Groups;
		
		// check input
		if (isset($_POST['Groups']))
        {
			$model->attributes = $_POST['Groups'];
			$model->subof = 6;
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
				
                $this->redirect( array('groups/show', 'id'=>$model->primaryKey ) );
            }
			
		}
		
		$this->render('create_group', array( 'model'=>$model ) );
	}
	
	private function reverseDate($date) {
		if ( $date == '' ) return 0;
		
	   $date = preg_split("[/]", $date);
	   $date = $date[2]."-".$date[1]."-".$date[0];
	   return $date;
	}
	
	public function actionAutocomplete(){
		if (isset($_GET['term'])) {			
			
			$group_id = (int) $_GET['group_id'];
			$criteria=new CDbCriteria;
			$criteria->alias = "users";
			$criteria->condition = "(users.firstname like '%" . $_GET['term'] . "%' or users.lastname like '%" . $_GET['term'] . "%') and NOT FIND_IN_SET($group_id, `member_groups`) ";
			//$criteria->addNotInCondition('id', array(1,2));
				
			$dataProvider = new CActiveDataProvider(get_class(Users::model()), array( 'criteria'=>$criteria, 'pagination'=>false ));
			
			$users = $dataProvider->getData();
				
			$return_array = array();
			foreach($users as $u) {
				$return_array[] = array(
					'label'=>$u->firstname.' '.$u->lastname, // field to show
					'value'=>$u->firstname.' '.$u->lastname,
					'id'=>$u->id,
				);
			}
			echo CJSON::encode($return_array);
		}
	}
	
	public function actionAddtogroup(){
		$model = Users::model()->findByPk( (int) $_POST['user_id'] );
		if ( $model->member_groups =='' )
		{			
			$model->member_groups = (int) $_POST['group_id'];
		}else{			
			$model->member_groups .= ','. (int) $_POST['group_id'];
		}
		
		if ( $model->save() )
		{
			echo 'ok';
		}
	}
	
	public function actionTest(){
		$model = Users::model()->findByPk( 1 );
		echo $model->group_id;
	}
	
}