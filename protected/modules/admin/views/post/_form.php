<div class="form">

<?php
Yii::app()->clientScript->registerScript('buttons', "
$('#btn-draft').click(function(){
    $('#Post_set_private').attr('checked', false);
    $('#Post_published').attr('checked', false);

    $('#post-form').submit();
});
$('#btn-postit').click(function(){
    var setPrivate = ".($model->status==DRAFT_POST ? 'true':'false').";
    if(!setPrivate || !$('#Post_set_private').attr('checked')) setPrivate = false;
    $('#Post_set_private').attr('checked',  setPrivate);
    $('#Post_published').attr('checked', true);

    $('#post-form').submit();
});
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>256,'class'=>'post-title')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>20, 'cols'=>50,'class'=>'post-content')); ?>
        <?php $this->widget('application.extensions.editor.editor', array(
            'name'=>'Post_content',
            'language'=>'zh_cn',
        )); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'taglist'); ?>
        <?php echo $form->textField($model, 'taglist', array('size'=>60, 'maxlength'=>256)); ?>
        <?php echo $form->error($model, 'taglist'); ?>
    </div>

    <div class="row">
        <span class="option">
        <?php echo Yii::t('post', 'Enable Comment'); ?>
        <?php echo $form->checkBox($model, 'enable_comment'); ?>
        <?php echo $form->error($model, 'enable_comment'); ?>
        </span>

        <span class="option">
        <?php echo Yii::t('post', 'Published'); ?>
        <?php echo CHtml::checkBox('Post[published]', $model->status!=DRAFT_POST); ?>
        <?php echo $form->error($model, 'status'); ?>
        </span>

        <span class="option">
        <?php echo Yii::t('post', 'Set Private'); ?>
        <?php echo CHtml::checkBox('Post[set_private]', $model->status==PRIVATE_POST); ?>
        <?php echo $form->error($model, 'status'); ?>
        </span>
    </div>

	<div class="row buttons">
        <?php if($model->status == DRAFT_POST): ?>
        <span class="option">
        <?php echo CHtml::button(Yii::t('post', 'Post it'), array(
            'id'=>'btn-postit',
        )); ?>
        </span>
        <?php endif; ?>

        <span class="option">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('post', 'Post it') : Yii::t('post', 'Save changes')); ?>
        </span>

        <?php if($model->isNewRecord): ?>
        <span class="option">
        <?php echo CHtml::button(Yii::t('post', 'Save as draft'), array(
            'id'=>'btn-draft',
        )); ?>
        </span>
        <?php endif; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
