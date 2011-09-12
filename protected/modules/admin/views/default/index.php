<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'default');
?>
<h1><?php echo Yii::t('controlpanel', 'Welcome'); ?>, <?php echo $user->nickname; ?> !</h1>

<div class="stat">
    <div style="display:table;width:100%;">
        <div style="display:table-cell;">
            <div><?php echo Yii::t('controlpanel', 'You have :'); ?></div>
            <table>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['selfPostNum'], Yii::t('admin', 'Posts'))); ?>
                    </td>
                </tr>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['selfCommentNum'], Yii::t('admin', 'Comments'))); ?>
                    </td>
                </tr>
            </table>
        </div>
        <div style="display:table-cell;">
            <div><?php echo Yii::t('controlpanel', 'There are :'); ?></div>
            <table>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['postNum'], Yii::t('admin', 'Posts'))); ?>
                    </td>
                </tr>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['commentNum'], Yii::t('admin', 'Comments'))); ?>
                    </td>
                </tr>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['tagNum'], Yii::t('admin', 'Tags'))); ?>
                    </td>
                </tr>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['pageNum'], Yii::t('admin', 'Pages'))); ?>
                    </td>
                </tr>
                <tr>
                    <td class="stat-item">
                        <?php echo str_replace('#', '&nbsp;', sprintf('%\'#10d %s', $stat['sitelogNum'], Yii::t('admin', 'Sitelogs'))); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
