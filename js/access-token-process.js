$(document).ready(function(){
    $('#not-access-token').on('click',function(){
        if($('#not-access-token-input').css('display') == 'none') {
            $('#not-access-token-input').show();
        } else {
            $('#not-access-token-input').hide();
        }
    });

    $('#access-token').on('click',function(){
        if($('#access-token-input').css('display') == 'none') {
            $('#access-token-input').show();
        } else {
            $('#access-token-input').hide();
        }
    });
});

