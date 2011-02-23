<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $nickname
 * @property string $email
 * @property string $last_login_time
 * @property integer $create_user_id
 * @property string $create_time
 * @property integer $update_user_id
 * @property string $update_time
 */
class User extends ArtActiveRecord
{
    public $password_repeat;
    public $min_last_login_time;
    public $max_last_login_time;
    public $min_create_time;
    public $max_create_time;
    public $min_update_time;
    public $max_update_time;

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, password, nickname, email', 'required'),
			array('name, password, nickname, email, url', 'length', 'max'=>256),
            array('name, email', 'unique'),
            array('password', 'compare'),
            array('password_repeat', 'safe'),
            array('url', 'url'),
            array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, password, nickname, email, url', 'safe', 'on'=>'search'),
			array('create_user_id,update_user_id,min_last_login_time,max_last_login_time,min_create_time,max_create_time,min_update_time,max_update_time', 'safe', 'on'=>'search'),
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
            'creator'=>array(self::BELONGS_TO, 'User', 'create_user_id'),
            'modifier'=>array(self::BELONGS_TO, 'User', 'update_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('user', 'ID'),
			'name' => Yii::t('user', 'Name'),
			'password' => Yii::t('user', 'Password'),
			'nickname' => Yii::t('user', 'Nickname'),
			'email' => Yii::t('user', 'Email'),
            'url' => Yii::t('user', 'URL'),
			'last_login_time' => Yii::t('user', 'Last Login Time'),
			'create_user_id' => Yii::t('user', 'Creator'),
			'create_time' => Yii::t('user', 'Create Time'),
			'update_user_id' => Yii::t('user', 'Modifier'),
			'update_time' => Yii::t('user', 'Update Time'),
            'password_repeat'=>Yii::t('user', 'Password Repeat'),
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('url',$this->url,true);

        if (!empty($this->create_user_id)) {
            $criteria->addCondition("exists (select 1 from art_user au where au.id=t.create_user_id and (au.name like '%{$this->create_user_id}%' or au.nickname like '%{$this->create_user_id}%'))");
        }

        if (!empty($this->update_user_id)) {
            $criteria->addCondition("exists (select 1 from art_user au where au.id=t.update_user_id and (au.name like '%{$this->update_user_id}%' or au.nickname like '%{$this->update_user_id}%'))");
        }

        if (!empty($this->min_last_login_time)) {
            $criteria->compare('t.last_login_time', '>='.$this->min_last_login_time);
        }

        if (!empty($this->max_last_login_time)) {
            $criteria->compare('t.last_login_time', '<='.$this->max_last_login_time);
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

        $criteria->order = 't.last_login_time DESC';

        if (Yii::app()->user->name !== 'admin') {
            $criteria->addCondition('t.id='.Yii::app()->user->id.' or t.create_user_id='.Yii::app()->user->id);
        }

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    protected function afterValidate()
    {
        parent::afterValidate();
        $this->password = $this->encrypt($this->password);
    }

    public function encrypt($text)
    {
        return md5($text);
    }
}
