<?php


class ChangePass extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Users the static model class
     */
	 
	public $confirm_password='';
	public $old_password='';
	 
    public static function model($className = __CLASS__ ) { // 'Users'
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('password, old_password, confirm_password', 'required' ),            
            array(' password,  old_password, confirm_password ', 'filter', 'filter'=>'trim'),			
			//array('confirm_password', 'safe'),
			//array('confirm_password', 'compare', 'compareAttribute'=>'password'  ),  // ,'on'=>'register'
			
        );
    }
	
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'confirm_password' => 'confirm_password',
            'old_password' => 'old_password',
            'password' => 'Password'

        );
    }
	
	//protected function afterValidate()
	//{
	//	parent::afterValidate();
	//	$this->password = $this->encrypt($this->password);
	//}
	
	//private function encrypt($v){
	//	return md5($v);
	//}

}