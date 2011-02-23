<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'View User');

$this->menu=array(
	array('label'=>Yii::t('user', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('user', 'Update User'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('user', 'Delete User'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('user', 'Manage Users'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'nickname',
		'email',
        'url',
		'last_login_time',
        array(
		    'name'=>'create_user_id',
            'value'=>$model->creator->nickname,
        ),
		'create_time',
        array(
		    'name'=>'update_user_id',
            'value'=>$model->modifier->nickname,
        ),
		'update_time',
	),
)); ?>
