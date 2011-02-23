<div class="comment">
At <?php echo $data->create_time.', '.CHtml::link(CHtml::encode($data->author), $data->url); ?> said:
<br>
<?php echo $data->content; ?>
</div>
