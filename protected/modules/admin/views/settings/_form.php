<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
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
        <td class="cell_content" colspan=3></td>
    </tr>
    -->
    <tr>
        <th class="cell_title"><?php echo $form->labelEx($model,'site_name'); ?></td>
        <td class="cell_content" colspan=3>
            <?php echo $form->textField($model, 'site_name'); ?>
            <?php echo $form->error($model,'site_name'); ?>
        </td>
    </tr>
    <tr>
        <th class="cell_title"><?php echo $form->labelEx($model, 'language'); ?></td>
        <td class="cell_content" colspan=3>
            <?php echo $form->dropDownList($model,'language',array('en_us'=>'English', 'zh_cn'=>Yii::t('settings', 'Simplified Chinese'))); ?>
            <?php echo $form->error($model,'language'); ?>
        </td>
    </tr>
    <tr>
        <td class="cell_editor" colspan=4>
            <div class="row buttons">
                <span class="option">
                    <?php echo CHtml::submitButton(Yii::t('admin', 'Save')); ?>
                </span>
            </div>
        </td>
    </tr>
</table>

<?php $this->endWidget(); ?>

</div><!-- form -->
