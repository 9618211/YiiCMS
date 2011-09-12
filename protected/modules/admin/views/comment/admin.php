<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Comments');

$this->menu=array(
    array('label'=>Yii::t('admin', 'Advanced Search'), 'url'=>array('#'), 'itemOptions'=>array('class'=>'search-button')),
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
			'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success && typeof data=="string" && data.length>0) alert(data); }',
            'template'=>'{delete}',
		),
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
	),
    'template'=>'
        <table>
            <tr>
                <td class="cgridview-items-td" colspan="2">{items}</td>
            </tr>
            <tr>
                <td class="cgridview-pager-td">{pager}</td>
                <td class="cgridview-summary-td">{summary}</td>
            </tr>
        </table>',
    'emptyText'=>Yii::t('comment', 'No comments yet.'),
)); ?>
