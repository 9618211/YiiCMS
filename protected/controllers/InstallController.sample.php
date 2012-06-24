<?php

class InstallController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $am = Yii::app()->authManager;

        $am->clearAll();

        /**
         * Operations
         **/
        $am->createOperation('readPost', 'Read posts');
        $am->createOperation('createPost', 'Create posts');
        $am->createOperation('updatePost', 'Update posts');
        $am->createOperation('deletePost', 'Delete posts');

        $am->createOperation('readPage', 'Read Pages');
        $am->createOperation('createPage', 'Create Pages');
        $am->createOperation('updatePage', 'Update Pages');
        $am->createOperation('deletePage', 'Delete Pages');

        $am->createOperation('readComment', 'Read Comments');
        $am->createOperation('createComment', 'Create Comments');
        $am->createOperation('updateComment', 'Update Comments');
        $am->createOperation('deleteComment', 'Delete Comments');

        $am->createOperation('readTag', 'Read Tags');
        $am->createOperation('createTag', 'Create Tags');
        $am->createOperation('updateTag', 'Update Tags');
        $am->createOperation('deleteTag', 'Delete Tags');

        $am->createOperation('readImage', 'Read Images');
        $am->createOperation('createImage', 'Create Images');
        $am->createOperation('updateImage', 'Update Images');
        $am->createOperation('deleteImage', 'Delete Images');

        $am->createOperation('readUser', 'Read Users');
        $am->createOperation('createUser', 'Create Users');
        $am->createOperation('updateUser', 'Update Users');
        $am->createOperation('deleteUser', 'Delete Users');
        $am->createOperation('changeRole', 'Change Users\' Roles');

        /**
         * Roles
         **/
        $role = $am->createRole('reader');
        $role->addChild('readPost');
        $role->addChild('readPage');
        $role->addChild('readComment');
        $role->addChild('readTag');
        $role->addChild('readImage');
        $role->addChild('readUser');
        $role->addChild('createComment');

        $role = $am->createRole('user');
        $role->addChild('reader');
        $role->addChild('createPost');
        $role->addChild('createTag');
        $role->addChild('createImage');
        // Task: updateOwnPost
        $bizRule = 'return Yii::app()->user->id==$params["post"]->create_user_id;';
        $task = $am->createTask('updateOwnPost', 'Update a post by author himself', $bizRule);
        $task->addChild('updatePost');
        $role->addChild('updateOwnPost');
        // Task: updateOwnComment
        $bizRule = 'return Yii::app()->user->id==$params["comment"]->create_user_id;';
        $task = $am->createTask('updateOwnComment', 'Update a comment by author himself', $bizRule);
        $task->addChild('updateComment');
        $role->addChild('updateOwnComment');
        // Task: updateSelf
        $bizRule = 'return Yii::app()->user->id==$params["user"]->id;';
        $task = $am->createTask('updateSelf', 'Update user himself', $bizRule);
        $task->addChild('updateUser');
        $role->addChild('updateSelf');
        // Task: deleteOwnPost
        $bizRule = 'return Yii::app()->user->id==$params["post"]->create_user_id;';
        $task = $am->createTask('deleteOwnPost', 'Delete a post by author himself', $bizRule);
        $task->addChild('deletePost');
        $role->addChild('deleteOwnPost');

        $role = $am->createRole('administrator');
        $role->addChild('user');
        $role->addChild('createPage');
        $role->addChild('createUser');
        $role->addChild('updatePage');
        $role->addChild('updateTag');
        $role->addChild('updatePost');
        $role->addChild('updateComment');
        $role->addChild('updateImage');
        $role->addChild('updateUser');
        $role->addChild('changeRole');
        $role->addChild('deletePage');
        $role->addChild('deleteUser');
        $role->addChild('deleteComment');
        $role->addChild('deleteTag');
        $role->addChild('deleteImage');
        $role->addChild('deletePost');

        $am->assign('administrator', 1);
        $am->assign('user', 2);

        # Set default settings
        Yii::app()->settings->set('common', 'site_name', 'YiiCMS');
        Yii::app()->settings->set('common', 'language', 'cn');

        echo 'Installation completed !';
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}
