<?php $this->beginContent(); ?>
<div class="xview">
    <table class="xview-table">
        <tr>
            <td class="xview-td xview-sidebar">
                <div id="sidebar">
                <?php
                    $this->beginWidget('zii.widgets.CPortlet', array(
                        'title'=>Yii::t('menu', 'Operations'),
                    ));
                    $this->widget('zii.widgets.CMenu', array(
                        'items'=>$this->menu,
                        'htmlOptions'=>array('class'=>'operations'),
                    ));
                    $this->endWidget();
                ?>
                </div><!-- sidebar -->
            </td>
            <td class="xview-td">
                <div id="content">
                    <?php echo $content; ?>
                </div><!-- content -->
            </td>
        </tr>
    </table>
</div>
<?php $this->endContent(); ?>
