<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sitelog-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>20, 'cols'=>50, 'class'=>'sitelog_content')); ?>
		<?php echo $form->error($model,'content'); ?>
        <script type="text/javascript" src="<?php echo Yii::app()->createUrl(''); ?>/js/nicEdit.js"></script>
        <script type="text/javascript">
        bkLib.onDomLoaded(function(){
            new nicEditor({
                iconsPath:'<?php echo Yii::app()->createUrl(''); ?>/js/nicEditorIcons.gif',
                buttonList : ['save','bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','indent','outdent','link','unlink','forecolor','bgcolor'],
            }).panelInstance('Sitelog_content');
        });
        </script>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
