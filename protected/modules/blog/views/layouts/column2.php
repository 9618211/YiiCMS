<?php $this->beginContent(); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="sidebar">
            <?php $this->widget('RecentComments'); ?>

            <div class="feed" id="feed">
                <a href="<?php echo Yii::app()->createUrl('blog/post/feed'); ?>"><img src="<?php echo Yii::app()->getBaseUrl(); ?>/images/feed.png"></a>
            </div>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>
