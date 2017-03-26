$(document).ready(function(){

    function resetView(id, next) {

        var isOpened = false;

        if($(id).is(":visible")) {
            isOpened = true;
        }

        $('#not-access-token-input').hide();
        $('#access-token-input').hide();

        if(next) {
            next(isOpened);
        }

    }

    $('.access-btn').click(function(event) {
        var id = $(event.currentTarget).data('target');

        resetView(id, function (isOpened) {
            if (!isOpened) {
                $(id).show();
            }

        });
    });
});

