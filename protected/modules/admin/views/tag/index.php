$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'Tag List');

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
