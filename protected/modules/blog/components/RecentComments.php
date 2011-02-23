<?php
Yii::import('zii.widgets.CPortlet');

class RecentComments extends CPortlet
{
    public $title = 'Recent Comments';
    public $limit = 10;

    public function __construct($owner)
    {
        parent::__construct($owner);
        $this->title = Yii::t('menu', 'Recent Comments');
    }

    public function getRecentComments()
    {
        return Comment::model()->findRecentComments($this->limit);
    }

    public function renderContent()
    {
        $this->render('recentComments');
    }
}
?>
