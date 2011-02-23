<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('maxlength'=>256)); ?>
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
		<?php echo $form->label($model,'create_time'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Post[min_create_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Post[max_create_time]',
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
            'name'=>'Post[min_update_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Post[max_update_time]',
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
