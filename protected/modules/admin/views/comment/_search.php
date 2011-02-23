<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Comment[min_create_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Comment[max_create_time]',
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
            'name'=>'Comment[min_update_time]',
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
            ),
        ));
        ?>
        -
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name'=>'Comment[max_update_time]',
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
