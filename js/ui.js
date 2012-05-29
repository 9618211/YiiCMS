
function resize_callback() {
    content_height = $('.xview').length===0 ? $('#content').height():$('.xview').height();
    header_height = $('#header').height();
    menubar_height = $('#mainmenu').height();
    footer_height = $('#footer').height();
    window_height = $(window).height();
    default_height = window_height-header_height-menubar_height-footer_height;
    if (content_height>default_height) {
        $('#footer').css('position', 'relative');
    }else{
        $('#footer').css('position', 'absolute');
    }
    $('#page').css('height', $('#footer').position().top+footer_height+30);
}

function hook_editor_callback(inst) {
    tinymce.dom.Event.add(inst.getWin(), 'resize', function(e) {
        resize_callback();
    });
}
