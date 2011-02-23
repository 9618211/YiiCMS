<div class="comments">
<?php
$dataProvider = new CActiveDataProvider('Comment', array(
    'criteria'=>array(
        'condition'=>'t.post_id=:postId',
        'order'=>'t.create_time DESC',
        'with'=>'creator',
        'params'=>array(
            ':postId'=>$model->id,
        ),
    ),
    'pagination'=>array(
        'pageSize'=>10,
    ),
));

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/comment/_view',
));
?>
</div>
