<ul>
    <?php foreach($this->getRecentComments() as $comment): ?>
    <li>
        <div class="time">
            <?php echo $comment->create_time; ?>
        </div>
        <div class="info">
            <?php echo $comment->authorLink; ?> on 
            <?php echo CHtml::link(CHtml::encode($comment->post->title), $comment->getUrl()); ?>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
