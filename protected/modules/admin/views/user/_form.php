<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php if ($model->inScenarios('insert, update')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>256)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    <?php endif; ?>

    <?php if ($model->inScenarios('insert, update') && Yii::app()->user->checkAccess('changeRole')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',$this->getRoleData()); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
    <?php endif; ?>

    <?php if ($model->inScenarios('password')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password',array('maxlength'=>256)); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>
    <?php endif; ?>

    <?php if ($model->inScenarios('insert, password')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',array('maxlength'=>256)); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_password_repeat'); ?>
		<?php echo $form->passwordField($model,'new_password_repeat',array('maxlength'=>256)); ?>
		<?php echo $form->error($model,'new_password_repeat'); ?>
	</div>
    <?php endif; ?>

    <?php if ($model->inScenarios('insert, update')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('maxlength'=>256)); ?>
		<?php echo $form->error($model,'nickname'); ?>
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
    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
