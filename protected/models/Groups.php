<?php


class Groups extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'category';
	}

	public function rules()
	{
		return array(
			array('name, description, privacy ', 'required'),
			array('subof, is_show', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'nodes'=>array(self::HAS_MANY, 'Nodes', 'id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'subof' => 'Subof',
			'is_show' => 'is_show',
		);
	}
	
}