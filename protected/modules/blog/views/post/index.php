<?php 
$this->pageTitle = Yii::app()->name;

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/post/_view',
    'template'=>"{items}\n{pager}",
    'emptyText'=>Yii::t('post', 'No posts yet.'),
));
?>
