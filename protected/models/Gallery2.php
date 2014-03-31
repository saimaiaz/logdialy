<?php

class Gallery2 extends CActiveRecord
{
    public static function model($className = 'nodes')
    {
        return parent::model('Gallery');
    }
		
    public function tableName()
    {
        return 'nodes';
    }
		
    public function rules()
    {
        return array(
            array(' title, text,category_id, user_id', 'required'),			
        );
    }
		
    public function relations()
    {		
        return array(
           // 'galleryPhotos' => array(self::HAS_MANY, 'GalleryPhoto', 'gallery_id', 'order' => '`rank` asc'),
        );
    }
		
    public function attributeLabels()
    {
        /*
		return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        );
		*/
    }
		
}