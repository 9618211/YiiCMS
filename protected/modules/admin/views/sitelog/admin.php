<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Sitelogs');

$this->menu=array(
	array('label'=>Yii::t('sitelog', 'Sitelog List'), 'url'=>array('index')),
	array('label'=>Yii::t('sitelog', 'Create Sitelog'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sitelog-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link(Yii::t('admin', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sitelog-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'create_time',
            'filter'=>false,
        ),
        array(
            'name'=>'create_user_id',
            'value'=>'$data->createUser->nickname',
        ),
        array(
            'name'=>'content',
            'type'=>'raw',
            'value'=>'$data->content',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
    'emptyText'=>Yii::t('sitelog', 'No site logs yet.'),
)); ?>
