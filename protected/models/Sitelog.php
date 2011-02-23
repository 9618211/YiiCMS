<?php

/**
 * This is the model class for table "{{sitelog}}".
 *
 * The followings are the available columns in table '{{sitelog}}':
 * @property integer $id
 * @property string $content
 * @property integer $create_user_id
 * @property string $create_time
 * @property integer $update_user_id
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property User $createUser
 * @property User $updateUser
 */
class Sitelog extends ArtActiveRecord
{
    public $min_create_time;
    public $max_create_time;
    public $min_update_time;
    public $max_update_time;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Sitelog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sitelog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('content, create_user_id, update_user_id', 'safe', 'on'=>'search'),
			array('min_create_time,max_create_time,min_update_time,max_update_time', 'safe', 'on'=>'search'),
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
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('sitelog', 'ID'),
			'content' => Yii::t('sitelog', 'Content'),
			'create_user_id' => Yii::t('sitelog', 'Author'),
			'create_time' => Yii::t('sitelog', 'Create Time'),
			'update_user_id' => Yii::t('sitelog', 'Modifier'),
			'update_time' => Yii::t('sitelog', 'Update Time'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('content',$this->content,true);

        if (!empty($this->create_user_id)) {
            $criteria->addCondition("exists (select 1 from art_user au where au.id=t.create_user_id and (au.name like '%{$this->create_user_id}%' or au.nickname like '%{$this->create_user_id}%'))");
        }

        if (!empty($this->update_user_id)) {
            $criteria->addCondition("exists (select 1 from art_user au where au.id=t.update_user_id and (au.name like '%{$this->update_user_id}%' or au.nickname like '%{$this->update_user_id}%'))");
        }

        if (!empty($this->min_create_time)) {
            $criteria->compare('t.create_time', '>='.$this->min_create_time);
        }

        if (!empty($this->max_create_time)) {
            $criteria->compare('t.create_time', '<='.$this->max_create_time);
        }

        if (!empty($this->min_update_time)) {
            $criteria->compare('t.update_time', '>='.$this->min_update_time);
        }

        if (!empty($this->max_update_time)) {
            $criteria->compare('t.update_time', '<='.$this->max_update_time);
        }

        $criteria->order = 't.create_time DESC';

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
