<div class="form">

<?php
Yii::app()->clientScript->registerScript('buttons', "
$('#btn-draft').click(function(){
    $(\"#Post_status_2\").attr('checked', true);
    $('#post-form').submit();
});
$('#btn-postit').click(function(){
    var status = $(\"input[name='Post[status]']:checked\").val();
    if(status == ".DRAFT_POST."){
        $(\"#Post_status_0\").attr('checked', true);
    }

    $('#post-form').submit();
});
$('#btn-preview').click(function(){
    window.open('".Yii::app()->createUrl('blog/post/view', array('id'=>$model->id))."');
});
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <table cellspacing=0 cellpadding=0 class="edit_form" id="edit_table">
        <!--
        <tr>
            <th class="cell_title"></td>
            <td class="cell_content col1"></td>
            <th class="cell_title"></td>
            <td class="cell_content col2"></td>
        </tr>
        <tr>
            <th class="cell_title"></td>
            <td class="cell_content" colspan=3></td>
        </tr>
        -->
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'title'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>256,'class'=>'post_title')); ?>
                <?php echo $form->error($model,'title'); ?>
            </td>
        </tr>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model, 'taglist'); ?></td>
            <td class="cell_content" colspan=3>
                <?php echo $form->textField($model, 'taglist', array('size'=>50, 'maxlength'=>256)); ?>
                <?php echo $form->error($model, 'taglist'); ?>
            </td>
        </tr>
        <tr>
            <td class="cell_editor" colspan=4>
                <?php
                $this->widget('application.extensions.krichtexteditor.KRichTextEditor', array(
                    'model' => $model,
                    'value' => $model->isNewRecord ? '' : $model->content,
                    'attribute' => 'content',
                    'options' => array(
                        'init_instance_callback'=>'hook_editor_callback',
                        'language'=>Yii::app()->settings->get('common', 'language'),
                        'width'=>'100%',
                        'height'=>'450px',
                        'theme'=>'advanced',
                        'skin'=>'o2k7',
                        'plugins'=>"autolink,lists,pagebreak,table,advhr,advimage,advlink,emotions,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,fullscreen,visualchars,nonbreaking,xhtmlxtras,advlist",
                        'theme_advanced_buttons1'=>"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                        'theme_advanced_buttons2'=>"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                        'theme_advanced_buttons3'=>"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                        //'theme_advanced_buttons4'=>"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                        'theme_advanced_toolbar_location'=>'top',
                        'theme_advanced_toolbar_align'=>'left',
                        'theme_advanced_statusbar_location'=>'bottom',
                        'theme_advanced_resizing'=>true,
                        'theme_advanced_resize_horizontal'=>false,
                    ),
                ));
                ?>
                <?php echo $form->error($model,'content'); ?>
            </td>
        </tr>
        <tr>
            <th class="cell_title"><?php echo $form->labelEx($model,'status'); ?></td>
            <td class="cell_content col1">
                <span class="option">
                <?php echo $form->radioButtonList($model, 'status', array(PUBLIC_POST=>Yii::t('post','Public'),PRIVATE_POST=>Yii::t('post','Private'),DRAFT_POST=>Yii::t('post','Draft')), array('separator'=>'&nbsp;')); ?>
                <?php echo $form->error($model, 'status'); ?>
                </span>
            </td>
            <th class="cell_title"><?php echo $form->labelEx($model,'enable_comment'); ?></td>
            <td class="cell_content col2">
                <span class="option">
                <?php echo $form->checkBox($model, 'enable_comment'); ?>
                <?php echo $form->error($model, 'enable_comment'); ?>
                </span>
            </td>
        </tr>
        <tr>
            <td class="cell_editor" colspan=4>
                <div class="row buttons">
                    <?php if($model->status == DRAFT_POST): ?>
                    <span class="option">
                    <?php echo CHtml::button(Yii::t('post', 'Post it'), array(
                        'id'=>'btn-postit',
                    )); ?>
                    </span>
                    <?php endif; ?>

                    <span class="option">
                    <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('post', 'Post it') : Yii::t('post', 'Save changes')); ?>
                    </span>

                    <?php if($model->isNewRecord): ?>
                    <span class="option">
                    <?php echo CHtml::button(Yii::t('post', 'Save as draft'), array(
                        'id'=>'btn-draft',
                    )); ?>
                    </span>
                    <?php endif; ?>

                    <?php if(!$model->isNewRecord): ?>
                    <span class="option">
                    <?php echo CHtml::button(Yii::t('post', $model->status == DRAFT_POST ? 'Preview' : 'View Post'), array(
                        'id'=>'btn-preview',
                    )); ?>
                    </span>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- form -->
