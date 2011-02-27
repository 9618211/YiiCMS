<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_user_id
 * @property string $create_time
 * @property integer $update_user_id
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $createUser
 * @property User $updateUser
 */
class Page extends ArtActiveRecord
{
    public $min_create_time;
    public $max_create_time;
    public $min_update_time;
    public $max_update_time;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Page the static model class
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
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title', 'length', 'max'=>256),
			array('content, taglist, enable_comment, status', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, content, create_user_id, update_user_id', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'post_id'),
			'author' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'modifier' => array(self::BELONGS_TO, 'User', 'update_user_id'),
            'tags'=>array(self::MANY_MANY, 'Tag', 'rel_post_tag(post_id,tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('post', 'ID'),
			'title' => Yii::t('post', 'Title'),
			'content' => Yii::t('post', 'Content'),
            'type'=>Yii::t('post', 'Type'),
			'create_user_id' => Yii::t('post', 'Author'),
			'create_time' => Yii::t('post', 'Create Time'),
			'update_user_id' => Yii::t('post', 'Modifier'),
			'update_time' => Yii::t('post', 'Update Time'),
            'enable_comment'=>Yii::t('post', 'Enable Comment'),
            'status'=>Yii::t('post', 'Status'),
            'taglist'=>Yii::t('post', 'Tags'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('type',$this->type);

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

        $criteria->compare('status', $this->status);

        $statusCond = 't.status='.PUBLIC_POST;
        if (!Yii::app()->user->isGuest) {
            $statusCond .= ' or t.create_user_id='.Yii::app()->user->id;
            $statusCond .= ' or 1='.Yii::app()->user->id;
        }
        $criteria->addCondition($statusCond);

        $criteria->order = 't.create_time DESC';

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    public function getTagList()
    {
        $arr = array();
        foreach ($this->tags as $tag) {
            $arr[] = $tag->name;
        }
        return implode(', ', $arr);
    }

    public function setTaglist($val)
    {
        $tags = array();

        $raw = explode(',', $val);
        array_walk($raw, 'walktrim');
        if (count($raw)>0 && !(count($raw)==1 && empty($raw[0]))) {
            foreach ($raw as $tagName) {
                $tag = Tag::model()->findByAttributes(array('name'=>$tagName));
                if (null === $tag) {
                    $tag = new Tag;
                    $tag->name = $tagName;
                }
                $tags[] = $tag;
            }
        }

        $this->tags = $tags;
    }

    protected function beforeValidate()
    {
        $this->type = PAGE_TYPE;

        return parent::beforeValidate();
    }

    protected function afterValidate()
    {
        parent::afterValidate();
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('blog/page/view', array('id'=>$this->id));
    }
}
