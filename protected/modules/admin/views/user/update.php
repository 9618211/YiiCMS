<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update User');

$this->menu=array(
	array('label'=>Yii::t('user', 'User List'), 'url'=>array('admin')),
	array('label'=>Yii::t('user', 'View User'), 'url'=>array('view', 'id'=>$model->id)),
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

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
