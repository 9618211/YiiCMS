<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $user = User::model()->findByAttributes(array(
            'name'=>Yii::app()->user->name,
        ));

        $stat = $this->getStatistics();

        $this->render('index', array(
            'user'=>$user,
            'stat'=>$stat,
        ));
	}

    public function getStatistics()
    {
        $stat = array();

        $stat['postNum'] = Post::model()->count(array(
            'condition'=>'t.type='.POST_TYPE,
        ));
        $stat['pageNum'] = Post::model()->count(array(
            'condition'=>'t.type='.PAGE_TYPE,
        ));
        $stat['tagNum'] = Tag::model()->count();
        $stat['commentNum'] = Comment::model()->count();
        $stat['sitelogNum'] = Sitelog::model()->count();

        return $stat;
    }
}
