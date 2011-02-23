<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user_id'); ?>
		<?php echo $form->textField($model,'create_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_user_id'); ?>
		<?php echo $form->textField($model,'update_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_login_time'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'User[min_last_login_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'User[max_last_login_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'User[min_create_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'User[max_create_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'User[min_update_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'User[max_update_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('admin', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
