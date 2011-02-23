<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'View Tag');

$this->menu=array(
	array('label'=>Yii::t('tag', 'Tag List'), 'url'=>array('index')),
	array('label'=>Yii::t('tag', 'Create Tag'), 'url'=>array('create')),
	array('label'=>Yii::t('tag', 'Update Tag'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('tag', 'Delete Tag'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('tag', 'Manage Tags'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
