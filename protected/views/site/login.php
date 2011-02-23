<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('loginform', 'Login');
$this->breadcrumbs=array(
	Yii::t('loginform', 'Login'),
);
?>

<div class="form login">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

    <table class="login-table">
        <tr>
            <td>
                <?php echo $form->labelEx($model,'username'); ?>
            </td>
            <td>
                <div class="row">
                    <?php echo $form->textField($model,'username'); ?>
                </div>
                <?php echo $form->error($model,'username'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'password'); ?>
            </td>
            <td>
                <div class="row">
                    <?php echo $form->passwordField($model,'password'); ?>
                </div>
                <?php echo $form->error($model,'password'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                    <?php echo $form->label($model,'rememberMe'); ?>
                    <?php echo $form->error($model,'rememberMe'); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="row buttons loginform-buttons">
                    <?php echo CHtml::submitButton(Yii::t('loginform', 'Login')); ?>
                </div>
            </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>
</div><!-- form -->
