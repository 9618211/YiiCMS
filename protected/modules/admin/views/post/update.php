<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Update Post');

$this->menu=array(
	array('label'=>Yii::t('post', 'Create Post'), 'url'=>array('create')),
	array('label'=>Yii::t('post', 'Manage Posts'), 'url'=>array('admin')),
	//array('label'=>Yii::t('post', 'Preview'), 'url'=>array('/blog/post/view', 'id'=>$model->id), array('target'=>'_blank')),
);
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
