<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'View Sitelog');
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
