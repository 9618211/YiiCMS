<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property integer $post_id
 * @property string $content
 * @property string $author
 * @property string $email
 * @property string $url
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 */
class Comment extends ArtActiveRecord
{
    public $min_create_time;
    public $max_create_time;
    public $min_update_time;
    public $max_update_time;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id, author, email, content', 'required'),
			array('post_id', 'numerical', 'integerOnly'=>true),
			array('author, email, url', 'length', 'max'=>256),
			array('content', 'safe'),
            array('email', 'email'),
            array('url', 'url'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, content, author, email, url', 'safe', 'on'=>'search'),
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
            'creator'=>array(self::BELONGS_TO, 'User', 'create_user_id'),
            'post'=>array(self::BELONGS_TO, 'Post', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('comment', 'ID'),
			'post_id' => Yii::t('comment', 'Post'),
			'content' => Yii::t('comment', 'Content'),
			'author' => Yii::t('comment', 'Author'),
			'email' => Yii::t('comment', 'Email'),
			'url' => Yii::t('comment', 'Url'),
			'create_time' => Yii::t('comment', 'Create Time'),
			'create_user_id' => Yii::t('comment', 'Author'),
			'update_time' => Yii::t('comment', 'Update Time'),
			'update_user_id' => Yii::t('comment', 'Modifier'),
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

        if (!empty($this->post_id)) {
            $criteria->addCondition("exists (select 1 from art_post ap where ap.id=t.post_id and ap.title like '%{$this->post_id}%')");
        }

		$criteria->compare('content',$this->content,true);

        if (!empty($this->author)) {
            $criteria->addCondition("t.author like '%{$this->author}%' or exists (select 1 from art_user au where au.id=t.create_user_id and (au.name like '%{$this->author}%' or au.nickname like '%{$this->author}%'))");
        }

		$criteria->compare('email',$this->email,true);
		$criteria->compare('url',$this->url,true);

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

    public function findRecentComments($limit=10)
    {
        return $this->with('post')->findAll(array(
            'order'=>'t.create_time DESC',
            'limit'=>$limit,
        ));
    }

    public function getUrl()
    {
        return $this->post->url.'#c'.$this->id;
    }

    public function getAuthorLink()
    {
        if (!empty($this->url)) {
            return CHtml::link(CHtml::encode($this->author), $this->url);
        } else {
            return CHtml::encode($this->author);
        }
    }

    protected function beforeValidate()
    {
        if (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $this->author = $user->nickname;
            $this->email = $user->email;
            $this->url = $user->url;
        }

        return parent::beforeValidate();
    }
}
