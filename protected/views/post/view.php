<h1><?php echo $model->title; ?></h1>

<div class="single_post_info">
Posted by <?php echo $model->author->name; ?>, in <?php echo $model->create_time; ?>
</div>

<div class="single_post_content">
    <?php echo $model->content; ?>
</div>

<?php $this->renderPartial('_comments', array('model'=>$model)); ?>

<?php
$this->renderPartial('/comment/_form', array(
    'model'=>$comment,
));
?>
