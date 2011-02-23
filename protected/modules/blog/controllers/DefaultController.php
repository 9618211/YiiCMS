<?php

class DefaultController extends Controller
{
	public $layout='column2';

    public function actions()
    {
        return array(
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

	public function actionIndex()
	{
        $statusCond = 't.status='.PUBLIC_POST;
        if (!Yii::app()->user->isGuest) {
            $statusCond .= ' or (t.status='.PRIVATE_POST.' and t.create_user_id='.Yii::app()->user->id.')';
        }

        $dataProvider=new CActiveDataProvider('Post', array(
            'criteria'=>array(
                'condition'=>'t.type='.POST_TYPE.' and ('.$statusCond.')',
                'order'=>'t.create_time DESC',
                'with'=>'author',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        // Register RSS feed
        /*
        Yii::app()->clientScript->registerLinkTag(
            'alternate',
            'application/rss+xml',
            $this->createUrl('/blog/post/feed')
        );
         */

		$this->render('/post/index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionSearch()
    {
        if (!isset($_GET['query_string']) || empty($_GET['query_string'])) {
            $this->redirect(Yii::app()->user->returnUrl);
        }

        $queryStr = $_GET['query_string'];
        $conds = array();
        foreach (preg_split('/[\s,]+/', $queryStr) as $keyword) {
            $conds[] = "t.content like '%$keyword%'";
        }

        $dataProvider=new CActiveDataProvider('Post', array(
            'criteria'=>array(
                'condition'=>implode(' and ', $conds),
                'order'=>'t.create_time DESC',
                'with'=>'author',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

		$this->render('/post/index',array(
			'dataProvider'=>$dataProvider,
		));
    }
}
