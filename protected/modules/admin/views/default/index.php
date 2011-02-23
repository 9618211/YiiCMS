<?php
$this->pageTitle = Yii::app()->name.' - '.Yii::t('admin', 'default');
?>
<h1><?php echo Yii::t('controlpanel', 'Welcome'); ?>, <?php echo $user->nickname; ?> !</h1>

<div class="stat">
    <table>
        <tr>
            <td class="stat-val">
                <?php echo $stat['postNum']; ?>
            </td>
            <td class="stat-item">
                <?php echo Yii::t('admin', 'Posts'); ?>
            </td>
        </tr>
        <tr>
            <td class="stat-val">
                <?php echo $stat['commentNum']; ?>
            </td>
            <td class="stat-item">
                <?php echo Yii::t('admin', 'Comments'); ?>
            </td>
        </tr>
        <tr>
            <td class="stat-val">
                <?php echo $stat['tagNum']; ?>
            </td>
            <td class="stat-item">
                <?php echo Yii::t('admin', 'Tags'); ?>
            </td>
        </tr>
        <tr>
            <td class="stat-val">
                <?php echo $stat['pageNum']; ?>
            </td>
            <td class="stat-item">
                <?php echo Yii::t('admin', 'Pages'); ?>
            </td>
        </tr>
        <tr>
            <td class="stat-val">
                <?php echo $stat['sitelogNum']; ?>
            </td>
            <td class="stat-item">
                <?php echo Yii::t('admin', 'Sitelogs'); ?>
            </td>
        </tr>
    </table>
</div>
