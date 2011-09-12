<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('loginform', 'Login');
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
                <?php echo $form->textField($model,'username'); ?>
                <?php echo $form->error($model,'username'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'password'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model,'password'); ?>
                <?php echo $form->error($model,'password'); ?>
            </td>
        </tr>
        <?php if(extension_loaded('gd')): ?>
        <tr>
            <td>
                <?php echo $form->labelEx($model,'verifyCode'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'verifyCode'); ?>
                <?php echo $form->error($model,'verifyCode'); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php $this->widget('CCaptcha', array(
                    'showRefreshButton'=>false,
                    'clickableImage'=>true,
                    'imageOptions'=>array(
                        'title'=>Yii::t('loginform', 'Click to get a new captcha.'),
                        'alt'=>Yii::t('loginform', 'Click to get a new captcha.'),
                        'style'=>'cursor:pointer',
                    ),
                )); ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2">
                <div class="rememberMe">
                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                    <?php echo $form->label($model,'rememberMe'); ?>
                    <?php echo $form->error($model,'rememberMe'); ?>
                    <span style="margin-left:88px;">
                        <?php echo CHtml::submitButton(Yii::t('loginform', 'Login')); ?>
                    </span>
                </div>
            </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>
</div><!-- form -->
