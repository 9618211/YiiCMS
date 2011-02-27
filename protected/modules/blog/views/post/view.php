<?php
$this->pageTitle = Yii::app()->name.' - '.CHtml::encode($model->title);
?>
<h1><?php echo CHtml::encode($model->title); ?></h1>

<div class="single-post-auth">
    <?php echo Yii::t('post', 'Posted by'); ?> <?php echo CHtml::encode($model->author->nickname); ?>, <?php echo $model->create_time; ?>
</div>

<div class="single-post-content">
    <?php echo $model->content; ?>
</div>

<div class="single-post-info">
    <?php echo Yii::t('post', 'Tags'); ?>: <?php echo $model->taglist; ?> | <?php echo Yii::t('post', 'Last updated'); ?>: <?php echo $model->update_time; ?>
</div>

<?php if($model->enable_comment): ?>

    <?php $this->renderPartial('_comments', array('model'=>$model)); ?>

    <h2><?php echo Yii::t('post', 'Leave a Comment'); ?>:</h2>

    <?php $this->renderPartial('/comment/_form', array('model'=>$comment,)); ?>

<?php endif; ?>
