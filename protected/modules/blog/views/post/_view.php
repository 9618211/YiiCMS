<div class="post">

    <div class="title"><?php echo CHtml::link(CHtml::encode($data->title), array('post/view', 'id'=>$data->id)); ?></div>

    <div class="author">
    <?php echo Yii::t('post', 'Posted by'); ?> <?php echo CHtml::encode($data->author->nickname); ?>, <?php echo CHtml::encode($data->create_time); ?>
    </div>

    <div class="content">
	<?php echo $data->content; ?>
    </div>

    <div class="nav">
    <?php echo Yii::t('post', 'Tags'); ?>: <?php echo $data->taglist; ?> | <?php echo Yii::t('post', 'Last updated'); ?>: <?php echo $data->update_time; ?>
    </div>

</div>
