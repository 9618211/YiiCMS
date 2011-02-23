<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Tags');

$this->menu=array(
	array('label'=>Yii::t('tag', 'Tag List'), 'url'=>array('index')),
	array('label'=>Yii::t('tag', 'Create Tag'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tag-grid', {
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
	'id'=>'tag-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
    'emptyText'=>Yii::t('tag', 'No tags yet.'),
)); ?>
