<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'View Sitelog');

$this->menu=array(
	array('label'=>Yii::t('sitelog', 'Sitelog List'), 'url'=>array('index')),
	array('label'=>Yii::t('sitelog', 'Create Sitelog'), 'url'=>array('create')),
	array('label'=>Yii::t('sitelog', 'Update Sitelog'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('sitelog', 'Delete Sitelog'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('sitelog', 'Manage Sitelogs'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'content',
		'create_user_id',
		'create_time',
		'update_user_id',
		'update_time',
	),
)); ?>
