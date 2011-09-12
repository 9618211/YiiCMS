<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('page', 'Manage Pages');

$this->menu=array(
    array('label'=>Yii::t('admin', 'Advanced Search'), 'url'=>array('#'), 'itemOptions'=>array('class'=>'search-button')),
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
		array(
			'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success && typeof data=="string" && data.length>0) alert(data); }',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("blog/page/view", array("id"=>$data->id))',
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
            'name'=>'create_time',
            'filter'=>false,
        ),
		/*
		'update_time',
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
)); ?>
