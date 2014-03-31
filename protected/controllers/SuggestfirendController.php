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
			
           // ¡ÓË¹´à¾×èÍãËé µéÍ§ÅêÍ¡ÍÔ¹¡èÍ¹à¢éÒË¹éÒàËÅèÒ¹Õé
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
			$subject = "ªÇ¹ÊÁÑ¤Ã ÊÁÒªÔ¡ àÇçºä«µì ÅêÍ¡ä´ÍĞÃÕèºØ­ àªÔ­ªÇ¹ãËé¤Ø³ÁÒºÑ¹·Ö¡ºØ­»ÃĞ¨ÓÇÑ¹¢Í§¤Ø³";
			$message = "à¾×èÍ¹¢Í§¤Ø³ª×èÍ ".Yii::app()->user->firstname.' ä´éàªÔ­¤Ø³ÁÒÊÁÑ¤ÃÊÁÒªÔ¡à¾×èÍä´éà¢éÒÃèÇÁÁÒºÑ¹·Ö¡ºØ­¡ØÈÅ ä´é·Õè http://www.tconnet.co.th/LogDailyBoon/';
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
        $params              = array('myMail'=>'àÇçºä«µì ÅêÍ¡ä´ÍĞÃÕèºØ­ àªÔ­ªÇ¹ãËé¤Ø³ÁÒºÑ¹·Ö¡ºØ­»ÃĞ¨ÓÇÑ¹¢Í§¤Ø³ ');
        $message->subject    = 'My TestSubject';
        $message->setBody($params, 'text/html');
        $message->addTo( $email );
        $message->from = 'admin@domain.com';   
        Yii::app()->mail->send($message);       
	}



}