<div class="form">

<?php
Yii::app()->clientScript->registerScript('buttons', "
$('#btn-draft').click(function(){
    $(\"#Post_status_2\").attr('checked', true);
    $('#post-form').submit();
});
$('#btn-postit').click(function(){
    var status = $(\"input[name='Post[status]']:checked\").val();
    if(status == ".DRAFT_POST."){
        $(\"#Post_status_0\").attr('checked', true);
    }

    $('#post-form').submit();
});
$('#btn-preview').click(function(){
    window.open('".Yii::app()->createUrl('blog/post/view', array('id'=>$model->id))."');
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

    <div class="row radio-group">
		<?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->radioButtonList($model, 'status', array(PUBLIC_POST=>Yii::t('post','Public'),PRIVATE_POST=>Yii::t('post','Private'),DRAFT_POST=>Yii::t('post','Draft')), array('separator'=>'&nbsp;')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <span class="option">
		<?php echo $form->labelEx($model,'enable_comment'); ?>
        <?php echo $form->checkBox($model, 'enable_comment'); ?>
        <?php echo $form->error($model, 'enable_comment'); ?>
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

        <?php if(!$model->isNewRecord): ?>
        <span class="option">
        <?php echo CHtml::button(Yii::t('post', $model->status == DRAFT_POST ? 'Preview' : 'View Post'), array(
            'id'=>'btn-preview',
        )); ?>
        </span>
        <?php endif; ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
