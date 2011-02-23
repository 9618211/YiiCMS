<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Sitelog List');

$this->menu=array(
	array('label'=>'Create Sitelog', 'url'=>array('create')),
	array('label'=>'Manage Sitelog', 'url'=>array('admin')),
);
?>

<h1>Sitelogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
