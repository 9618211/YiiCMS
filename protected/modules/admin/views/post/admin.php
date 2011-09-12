<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Posts');

$this->menu=array(
    array('label'=>Yii::t('admin', 'Advanced Search'), 'url'=>array('#'), 'itemOptions'=>array('class'=>'search-button')),
	array('label'=>Yii::t('post', 'Create Post'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('post-grid', {
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
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success && typeof data=="string" && data.length>0) alert(data); }',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("blog/post/view", array("id"=>$data->id))',
                    'options'=>array(
                        'target'=>'_blank',
                    ),
                ),
            ),
		),
		'title',
        array(
            'name'=>'create_user_id',
            'value'=>'$data->author->nickname',
        ),
        array(
            'name'=>'update_user_id',
            'value'=>'$data->modifier->nickname',
        ),
        array(
            'name'=>'create_time',
            'filter'=>false,
        ),
        array(
            'name'=>'update_time',
            'filter'=>false,
        ),
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
    'emptyText'=>Yii::t('post', 'No posts yet.'),
)); ?>
