<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <table cellspacing=0 cellpadding=0 class="edit_form" id="edit_table">
        <!--
        <tr>
            <th class="cell_title"></td>
            <td class="cell_content col1"></td>
            <th class="cell_title"></td>
            <td class="cell_content col2"></td>
        </tr>
        <tr>
            <th class="cell_title"></td>
            <td class="cell_content" colspan=3>
            </td>
        </tr>
        -->
        <?php if ($model->inScenarios('insert, update')): ?>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'name'); ?></td>
            <td class="cell_content col1" colspan=3>
                <?php echo $form->textField($model,'name',array('maxlength'=>256)); ?>
                <?php echo $form->error($model,'name'); ?>
            </td>
        </tr>
        <?php endif; ?>
        <?php if ($model->inScenarios('insert, update') && Yii::app()->user->checkAccess('changeRole')): ?>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'role'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->dropDownList($model,'role',$this->getRoleData()); ?>
                <?php echo $form->error($model,'role'); ?>
            </td>
        </tr>
        <?php endif; ?>
        <?php if ($model->inScenarios('password')): ?>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'old_password'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->passwordField($model,'old_password',array('maxlength'=>256)); ?>
                <?php echo $form->error($model,'old_password'); ?>
            </td>
        </tr>
        <?php endif; ?>
        <?php if ($model->inScenarios('insert, password')): ?>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'new_password'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->passwordField($model,'new_password',array('maxlength'=>256)); ?>
                <?php echo $form->error($model,'new_password'); ?>
            </td>
        </tr>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'new_password_repeat'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->passwordField($model,'new_password_repeat',array('maxlength'=>256)); ?>
                <?php echo $form->error($model,'new_password_repeat'); ?>
            </td>
        </tr>
        <?php endif; ?>
        <?php if ($model->inScenarios('insert, update')): ?>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'nickname'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->textField($model,'nickname',array('maxlength'=>256)); ?>
                <?php echo $form->error($model,'nickname'); ?>
            </td>
        </tr>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'email'); ?></td>
            <td class="cell_content col1">
                <?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>256)); ?>
                <?php echo $form->error($model,'email'); ?>
            </td>
            <th class="cell_title"><?php echo $form->labelEx($model,'url'); ?></td>
            <td class="cell_content col2">
                <?php echo $form->textField($model,'url',array('size'=>30,'maxlength'=>256)); ?>
                <?php echo $form->error($model,'url'); ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td class="cell_content" colspan=4>
                <div class="row buttons">
                    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
                </div>
            </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- form -->
