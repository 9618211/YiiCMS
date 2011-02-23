<div class="comment" id="c<?php echo $data->id; ?>">
    <div class="author">
        At <?php echo $data->create_time.', '.CHtml::link(CHtml::encode($data->author), $data->url); ?> said:
    </div>
    <div class="content">
        <?php echo $data->content; ?>
    </div>
</div>
