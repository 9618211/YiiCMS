<?php
/**
 * 
 **/
class GalleryForm extends CFormModel
{
    public $image;

    public function rules()
    {
        return array(
            array('image', 'file', 'types'=>'png,jpg,gif'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'image'=>Yii::t('gallery', 'Image'),
        );
    }
}
