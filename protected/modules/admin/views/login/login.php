<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t('loginform', 'Login');
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

    <?php $opts = array('class'=>'input'); ?>
    <p>
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',$opts); ?>
        <?php echo $form->error($model,'username'); ?>
    </p>
    <p>
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',$opts); ?>
        <?php echo $form->error($model,'password'); ?>
    </p>
    <?php if(extension_loaded('gd')): ?>
    <p>
        <?php echo $form->labelEx($model,'verifyCode'); ?>
        <?php echo $form->textField($model,'verifyCode',$opts); ?>
        <?php echo $form->error($model,'verifyCode'); ?>
    </p>
    <p>
        <?php $this->widget('CCaptcha', array(
            'showRefreshButton'=>false,
            'clickableImage'=>true,
            'imageOptions'=>array(
                'title'=>Yii::t('loginform', 'Click to get a new captcha.'),
                'alt'=>Yii::t('loginform', 'Click to get a new captcha.'),
                'style'=>'cursor:pointer',
            ),
        )); ?>
    </p>
    <?php endif; ?>
    <p class="rememberme">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </p>
    <p class="submit">
        <?php echo CHtml::submitButton(Yii::t('loginform', 'Login')); ?>
    </p>

<?php $this->endWidget(); ?>
</div><!-- form -->
