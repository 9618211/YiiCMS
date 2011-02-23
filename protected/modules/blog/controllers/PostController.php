<?php
Yii::import('application.vendors.*');
require_once('Zend/Feed.php');
require_once('Zend/Feed/Rss.php');

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','feed'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $post = $this->loadModel($id);
        $comment = new Comment;
        if (isset($_POST['Comment'])) {
            $comment->attributes = $_POST['Comment'];
            $comment->post_id = $post->id;
            if ($comment->save()) {
                $comment = new Comment;
            }
        }

		$this->render('view',array(
			'model'=>$post,
            'comment'=>$comment,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Post');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionFeed()
    {
        if (isset($_GET['tag'])) {
            $tagName = url_decode($_GET['tag']);
        } else {
            $tagName = null;
        }

        $posts = Post::model()->findRecentPosts(10, $tagName);
        $entries = array();

        foreach ($posts as $post) {
            $entries[] = array(
                'title'=>$post->title,
                'link'=>CHtml::encode($this->createAbsoluteUrl('post/view', array('id'=>$post->id))),
                'description'=>$post->content,
                'lastUpdate'=>strtotime($post->update_time),
                'author'=>$post->author->name,
            );
        }

        $feed = Zend_Feed::importArray(array(
            'title'=>Yii::app()->name,
            'link'=>$this->createUrl(''),
            'charset'=>'UTF-8',
            'entries'=>$entries,
        ), 'rss');

        $feed->send();
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
        $statusCond = 't.status='.PUBLIC_POST;
        if (!Yii::app()->user->isGuest) {
            $statusCond .= ' or t.create_user_id='.Yii::app()->user->id;
        }

        $model=Post::model()->find(array(
            'condition'=>'t.id='.$id.' and t.type='.POST_TYPE.' and ('.$statusCond.')',
        ));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
