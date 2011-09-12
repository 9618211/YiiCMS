<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $old_password
 * @property string $new_password
 * @property string $new_password_repeat
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
    public $role;
    public $old_password;
    public $new_password;
    public $new_password_repeat;
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
			array('name, nickname, email, role', 'required'),
			array('old_password', 'required', 'on'=>'password'),
            array('new_password, new_password_repeat', 'required', 'on'=>'insert, password'),
			array('name, password, nickname, email, url, old_password, new_password, new_password_repeat', 'length', 'max'=>256),
            array('url', 'url'),
            array('email', 'email'),
            array('name, email', 'unique'),
            array('old_password', 'safe', 'on'=>'password'),
            array('new_password, new_password_repeat', 'safe', 'on'=>'insert, password'),
            array('new_password', 'compare', 'on'=>'insert, password'),
            array('old_password', 'checkPassword', 'on'=>'password'),
			// The following rule is used by search().
			array('name, nickname, email, url, create_user_id,update_user_id,min_last_login_time,max_last_login_time,min_create_time,max_create_time,min_update_time,max_update_time', 'safe', 'on'=>'search'),
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
            'old_password'=>Yii::t('user', 'Old Password'),
            'new_password'=>Yii::t('user', 'New Password'),
            'new_password_repeat'=>Yii::t('user', 'Password Repeat'),
            'role'=>Yii::t('user', 'role'),
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
            //'pagination'=>array('pageSize'=>1,),
		));
	}

    /**
     * Encrypt the new password
     **/
    protected function afterValidate()
    {
        parent::afterValidate();
        $this->password = $this->inScenarios('insert, password') ? $this->encrypt($this->new_password) : $this->password;
    }

    /**
     * Eagerly load roles
     **/
    protected function afterFind()
    {
        parent::afterFind();
        $this->role = key(Yii::app()->authManager->getRoles($this->id));
    }

    /**
     * Role assignment
     **/
    protected function afterSave()
    {
        parent::afterSave();
        $oldRole = key(Yii::app()->authManager->getRoles($this->id));
        if ($oldRole != $this->role) {
            Yii::app()->authManager->revoke($oldRole, $this->id);
            Yii::app()->authManager->assign($this->role, $this->id);
        }
    }

    /**
     * Return the md5 value of the given string
     * @param string $text
     **/
    public function encrypt($text)
    {
        return md5($text);
    }

    /**
     * Validator method which check password while changing passwords.
     * @param string $attr the old_password attribute
     * @param array  $params the parameters for this validator.
     **/
    public function checkPassword($attr, $params)
    {
        if ($this->password !== md5($this->old_password)) {
            $this->addError($attr, Yii::t('user', 'Incorrect password.'));
        }
    }
}
