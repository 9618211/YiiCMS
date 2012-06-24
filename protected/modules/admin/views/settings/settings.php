<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('settings', 'Common');

$this->menu=array(
    array('label'=>Yii::t('settings', 'Common'), 'url'=>array('common')),
);
?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<?php
echo $this->renderPartial('_form', array('model'=>$model));
?>
