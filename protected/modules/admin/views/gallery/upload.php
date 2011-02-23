<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('gallery', 'Upload Images');

$this->menu=array(
	array('label'=>Yii::t('gallery', 'Manage Images'), 'url'=>array('/admin/gallery')),
);
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'gallery-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo CHtml::activeFileField($model, 'image'); ?>
    <?php echo $form->error($model,'image'); ?>
</div>

<div class="row_buttons">
    <?php echo CHtml::submitButton(Yii::t('admin', 'Upload')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
