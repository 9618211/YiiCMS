<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Sitelogs');

$this->menu=array(
    array('label'=>Yii::t('admin', 'Advanced Search'), 'url'=>array('#'), 'itemOptions'=>array('class'=>'search-button')),
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
			'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success && typeof data=="string" && data.length>0) alert(data); }',
            'template'=>'{update}{delete}',
		),
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
    'emptyText'=>Yii::t('sitelog', 'No site logs yet.'),
)); ?>
