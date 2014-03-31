<?php

/**
 * This is the model class for table "nodes".
 *
 * The followings are the available columns in table 'nodes':
 * @property string $id
 * @property string $title
 * @property string $text
 * @property string $date_create
 * @property string $date_update
 * @property string $picture
 * @property integer $user_receive_id
 * @property integer $user_send_id
 * @property integer $category_id
 * @property string $parent_id
 */

class Dhamma extends CActiveRecord
{	
	public $samma;
	public $time_samati;
	public $goodness;	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'nodes';
	}
	
	public function rules()
	{
		return array(
			array('title, text, date_create, date_update, user_id, category_id, parent_id, samma, time_samati, goodness', 
				'required', 'message'=>'กรุณากรอกช่องนี้ด้วย' ),
			array('user_id, category_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			
			array('id, title, text, date_create, date_update, user_id, category_id, parent_id ', 'safe', 'on'=>'search'),
			array('picture', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'insert, update'), 
		);
	}

	public function relations()
	{
		return array(
                    'users'=>array(self::BELONGS_TO, 'Users', 'user_id'),
                    'category'=>array(self::BELONGS_TO, 'Category', 'category_id'),
                    'satoo'=>array(self::HAS_MANY, 'Satoo', 'satoo_id'),
					
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'text' => 'Text',
			'date_create' => 'Date Create',
			'date_update' => 'Date Update',
            'picture' => 'picture',
			'user_id' => 'User',
			'category_id' => 'Category',
			'parent_id' => 'Parent',
		);
	}


	public function search()
	{

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('parent_id',$this->parent_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}