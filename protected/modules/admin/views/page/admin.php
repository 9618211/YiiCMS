<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('page', 'Manage Pages');

$this->menu=array(
	array('label'=>Yii::t('page', 'Create Page'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
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
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
        array(
            'name'=>'create_user_id',
            'value'=>'$data->author->nickname',
        ),
        array(
            'name'=>'create_time',
            'filter'=>false,
        ),
		/*
		'update_time',
		*/
		array(
			'class'=>'CButtonColumn',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("blog/page/view", array("id"=>$data->id))',
                    'options'=>array(
                        'target'=>'_blank',
                    ),
                ),
            ),
		),
	),
)); ?>
