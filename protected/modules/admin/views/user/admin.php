<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Manage Users');

$this->menu=array(
    array('label'=>Yii::t('admin', 'Advanced Search'), 'url'=>array('#'), 'itemOptions'=>array('class'=>'search-button')),
	array('label'=>Yii::t('user', 'Create User'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CButtonColumn',
            'htmlOptions'=>array(
                'style'=>'width:80px',
            ),
            'afterDelete'=>'function(link,success,data){ if(success && typeof data=="string" && data.length>0) alert(data); }',
            'template'=>'{view}{update}{delete}{password}',
            'buttons'=>array(
                'password'=>array(
                    'label'=>'Change Password',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/password.png',
                    'url'=>'Yii::app()->createUrl("admin/user/update", array("id"=>$data->id, "scene"=>"password"))',
                ),
            ),
		),
		'name',
        array(
		    'name'=>'nickname',
            'type'=>'raw',
            'value'=>'CHtml::link($data->nickname, $data->url)',
        ),
		'email',
        'url',
        array(
            'name'=>'last_login_time',
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
)); ?>
