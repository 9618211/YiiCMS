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
 */
class Post extends ArtActiveRecord
{
    public $min_create_time;
    public $max_create_time;
    public $min_update_time;
    public $max_update_time;
    public $set_private;
    public $published;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
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
			array('title, taglist', 'length', 'max'=>256),
			array('content, taglist, enable_comment, set_private, published', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, content, create_user_id', 'safe', 'on'=>'search'),
			array('min_create_time, max_create_time, min_update_time, max_update_time', 'safe', 'on'=>'search'),
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
            'author'=>array(self::BELONGS_TO, 'User', 'create_user_id'),
            'modifier'=>array(self::BELONGS_TO, 'User', 'update_user_id'),
            'comments'=>array(self::HAS_MANY, 'Comment', 'post_id'),
            'tags'=>array(self::MANY_MANY, 'Tag', 'rel_post_tag(post_id,tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'title' => Yii::t('post', 'Title'),
			'content' => Yii::t('post', 'Content'),
            'type'=>Yii::t('post', 'Type'),
			'create_user_id' => Yii::t('post', 'Author'),
			'create_time' => Yii::t('post', 'Create Time'),
			'update_user_id' => Yii::t('post', 'Modifier'),
			'update_time' => Yii::t('post', 'Update Time'),
            'taglist'=>Yii::t('post', 'Tags'),
            'enable_comment'=>Yii::t('post', 'Enable Comment'),
            'status'=>Yii::t('post', 'Status'),
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

        $criteria->with = array(
            'author',
        );

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
        $this->type = POST_TYPE;

        if ($this->set_private == 1) {
            $this->status = PRIVATE_POST;
        } else if ($this->published == 1) {
            $this->status = PUBLIC_POST;
        } else {
            $this->status = DRAFT_POST;
        }

        return parent::beforeValidate();
    }

    protected function afterValidate()
    {
        parent::afterValidate();
    }

    public function findRecentPosts($limit=10, $tagName=null)
    {
        if (null === $tagName) {
            return self::model()->with('author')->findAll(array(
                'condition'=>'t.type='.POST_TYPE.' and t.status='.PUBLIC_POST,
                'order'=>'t.create_time DESC',
                'limit'=>$limit,
            ));
        } else {
            return self::model()->with('author')->findAll(array(
                'order'=>'t.create_time DESC',
                'limit'=>$limit,
                'condition'=>'t.type='.POST_TYPE.' and t.status='.PUBLIC_POST.' and exists (select 1 from art_tag at,rel_post_tag rpt where at.id=rpt.tag_id and rpt.post_id=t.id and at.name=:tagName)',
                'params'=>array(
                    ':tagName'=>$tagName,
                ),
            ));
        }
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('blog/post/view', array('id'=>$this->id));
    }
}
