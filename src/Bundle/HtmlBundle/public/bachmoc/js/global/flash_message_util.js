global.FlashMessageUtil = {
    init: function() {
        setTimeout( function() {
            $('.alert .close').click();
        }, 5000);
    }
};

$(function() {
    FlashMessageUtil.init();
});