<?php

class SuggestfirendController extends Controller
{

	public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'users' => array('@'),
            ),			
			
           // ��˹�������� ��ͧ��͡�Թ��͹���˹������ҹ��
			array('deny',  // deny all anonymous
				'actions' => array('index'  ),
				'users'=>array('*'),
			),         
        );
    }

	public function actionIndex()
	{		
		if ( $_POST )
		{			
			//$this->sendSuggestEmail( $_POST['email'] );
			
			$to =  $_POST['email'];
			$subject = "�ǹ��Ѥ� ��Ҫԡ ���䫵� ��͡������ح �ԭ�ǹ���س�Һѹ�֡�ح��Ш��ѹ�ͧ�س";
			$message = "���͹�ͧ�س���� ".Yii::app()->user->firstname.' ���ԭ�س����Ѥ���Ҫԡ��������������Һѹ�֡�ح���� ���� http://www.tconnet.co.th/LogDailyBoon/';
			$from = "http://www.logdailyboon.com";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			
		}
		
		$this->render('index');
	}
	
	private function sendSuggestEmail( $email ){
		$message            = new YiiMailMessage;
           //this points to the file test.php inside the view path
        $message->view = "test";
        $params              = array('myMail'=>'���䫵� ��͡������ح �ԭ�ǹ���س�Һѹ�֡�ح��Ш��ѹ�ͧ�س ');
        $message->subject    = 'My TestSubject';
        $message->setBody($params, 'text/html');
        $message->addTo( $email );
        $message->from = 'admin@domain.com';   
        Yii::app()->mail->send($message);       
	}



}