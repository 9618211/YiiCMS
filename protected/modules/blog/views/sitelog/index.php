<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Sitelog List');
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'emptyText'=>Yii::t('sitelog', 'No site logs yet.'),
    'template'=>"{items}\n{pager}",
)); ?>
