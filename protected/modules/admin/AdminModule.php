<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
        $this->layout = 'main';
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            if (Yii::app()->user->isGuest && !strstr(Yii::app()->request->requestUri, 'admin/login')) {
                Yii::app()->request->redirect(Yii::app()->createURL('admin/login'));
            }
			return true;
		}
		else
			return false;
	}
}
