<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'View User');

$this->menu=array(
	array('label'=>Yii::t('user', 'User List'), 'url'=>array('admin')),
	array('label'=>Yii::t('user', 'Update User'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('user', 'Change Password'), 'url'=>array('update', 'id'=>$model->id, 'scene'=>'password')),
    array('label'=>Yii::t('user', 'Delete User'), 'url'=>'#', 
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>Yii::t('user', 'Are you sure you want to delete this user ?'),
        )
    ),
	array('label'=>Yii::t('user', 'Create User'), 'url'=>array('create')),
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
