<?php

class PostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';
    public $defaultAction = 'admin';

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->checkAccess('createPost');

		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];

            $transaction = Yii::app()->db->beginTransaction();
            try {
                // Save post.
                if(!$model->save())
                    throw new Exception(Yii::t('post', 'Failed to save this post.'));

                // Save tags.
                foreach ($model->tags as $tag) {
                    if ($tag->isNewRecord && !$tag->save()) {
                        $errors = $tag->getErrors();
                        $errors = array_reverse($errors, true);
                        $error = array_pop($errors);
                        $model->addError('taglist', "($tag->name)".$error[0]);
                        throw new Exception(Yii::t('post', 'Failed to save tags.'));
                    }
                    // save relation
                    $sql = 'insert into rel_post_tag (post_id,tag_id) values (:postId, :tagId)';
                    $cmd = Yii::app()->db->createCommand($sql);
                    $cmd->bindValue(':postId', $model->id);
                    $cmd->bindValue(':tagId', $tag->id);
                    if (!$cmd->execute()){
                        $model->addError('taglist', sprintf(Yii::t('post', "Failed to save the relationship between this post and tag (%s)."), $tagName));
                        throw new Exception(Yii::t('post', 'Failed to save the relation to tags.'));
                    }
                }

                $transaction->commit();
                Yii::app()->user->setFlash('success', Yii::t('post', 'Post has been saved.'));
				$this->redirect(array('update','id'=>$model->id));
            } catch ( Exception $e ) {
                $transaction->rollback();
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        $this->checkAccess('updatePost|updateOwnPost', array('post'=>$model));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];

            $transaction = Yii::app()->db->beginTransaction();
            try {
                // Save post.
                if(!$model->save())
                    throw new Exception(Yii::t('post', 'Failed to save this post.'));

                // Save tags.
                foreach ($model->tags as $tag) {
                    if ($tag->isNewRecord && !$tag->save()) {
                        $errors = $tag->getErrors();
                        $errors = array_reverse($errors, true);
                        $error = array_pop($errors);
                        $model->addError('taglist', "($tagName)".$error[0]);
                        throw new Exception(Yii::t('post', 'Failed to save tags.'));
                    }
                    // Drop relation if exists.
                    $sql = 'delete from rel_post_tag where post_id=:postId and tag_id=:tagId';
                    $cmd = Yii::app()->db->createCommand($sql);
                    $cmd->bindValue(':postId', $model->id);
                    $cmd->bindValue(':tagId', $tag->id);
                    $cmd->execute();
                    // Save relation.
                    $sql = 'insert into rel_post_tag (post_id,tag_id) values (:postId, :tagId)';
                    $cmd = Yii::app()->db->createCommand($sql);
                    $cmd->bindValue(':postId', $model->id);
                    $cmd->bindValue(':tagId', $tag->id);
                    if (!$cmd->execute()){
                        $model->addError('taglist', sprintf(Yii::t('post', "Failed to save the relationship between this post and tag (%s)."), $tagName));
                        throw new Exception(Yii::t('post', 'Failed to save the relation to tags.'));
                    }
                }

                $transaction->commit();
                Yii::app()->user->setFlash('success', Yii::t('post', 'Post has been updated.'));
				$this->redirect(array('update','id'=>$model->id));
            } catch ( Exception $e ) {
                $transaction->rollback();
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        // we only allow deletion via POST request
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel($id);

            try {
                $this->checkAccess('deletePost|deleteOwnPost', array('post'=>$model), null);
            } catch ( Exception $e ) {
                if(!isset($_GET['ajax']))
                    throw $e;
                else
                    echo $e->getMessage();
                return;
            }

            $model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $this->checkAccess('user');

		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

        $model->type = POST_TYPE;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
        $model=Post::model()->find(array(
            'condition'=>'t.id='.$id.' and t.type='.POST_TYPE.' and (t.status='.PUBLIC_POST.' or t.create_user_id='.Yii::app()->user->id.' or 1='.Yii::app()->user->id.')',
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
