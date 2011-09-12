<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'post_id'); ?>

    <?php if(Yii::app()->user->isGuest): ?>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

    <?php else: ?>

    <div class="row form-title">
        <?php echo Yii::app()->user->name; ?>:
    </div>
    
    <?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
        <script type="text/javascript" src="<?php echo Yii::app()->createUrl(''); ?>/js/nicEdit.js"></script>
        <script type="text/javascript">
        bkLib.onDomLoaded(function(){
            new nicEditor({
                iconsPath:'<?php echo Yii::app()->createUrl(''); ?>/js/nicEditorIcons.gif',
                buttonList : ['save','bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','indent','outdent','link','unlink','forecolor','bgcolor'],
            }).panelInstance('Comment_content');
        });
        </script>
	</div>

    <?php if(extension_loaded('gd') && !Yii::app()->user->checkAccess('createComment')): ?>
	<div class="row">
        <?php echo $form->labelEx($model,'verifyCode'); ?>
        <div style="display:table;">
            <div style="display:table-cell;vertical-align:middle;">
                <?php echo $form->textField($model,'verifyCode'); ?>
                <?php echo $form->error($model,'verifyCode'); ?>
            </div>
            <div style="display:table-cell;">
                <?php $this->widget('CCaptcha', array(
                    'showRefreshButton'=>false,
                    'clickableImage'=>true,
                    'imageOptions'=>array(
                        'title'=>Yii::t('loginform', 'Click to get a new captcha.'),
                        'alt'=>Yii::t('loginform', 'Click to get a new captcha.'),
                        'style'=>'cursor:pointer',
                    ),
                )); ?>
            </div>
        </div>
	</div>
    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
