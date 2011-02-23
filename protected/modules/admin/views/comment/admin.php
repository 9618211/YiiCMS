<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Comments');

$this->menu=array(
	//array('label'=>'Create Comment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('comment-grid', {
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
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'post_id',
            'value'=>'$data->post->title',
        ),
		'content',
        array(
            'name'=>'author',
            'type'=>'raw',
            'value'=>'CHtml::link($data->author, $data->url)',
        ),
		'email',
        array(
            'name'=>'create_time',
            'filter'=>false,
        ),
		/*
		'create_user_id',
		'update_time',
		'update_user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
    'emptyText'=>Yii::t('comment', 'No comments yet.'),
)); ?>
