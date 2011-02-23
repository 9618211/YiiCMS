<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('gallery', 'Manage Images');

$this->menu=array(
	array('label'=>Yii::t('gallery', 'Upload Images'), 'url'=>array('upload')),
);
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'gallery-grid',
    'dataProvider'=>new CArrayDataProvider($images, array(
        'pagination'=>array(
            'pageSize'=>10,
        ),
    )),
    'columns'=>array(
        array(
            'name'=>Yii::t('gallery', 'thumbnail'),
            'type'=>'raw',
            'value'=>'CHtml::image($data["url"], "", array(
                "width"=>150,
            ))',
        ),
        array(
            'name'=>Yii::t('gallery', 'name'),
            'value'=>'$data["name"]',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("admin/gallery/delete", array(
                        "name"=>$data["filename"],
                    ))',
                ),
            ),
        ),
    ),
    'emptyText'=>Yii::t('gallery', 'No images yet.'),
));
?>
