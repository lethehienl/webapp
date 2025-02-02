global.FlashMessageUtil = {
    init: function () {
        setTimeout(function () {
            if ($('.alert').hasClass('alert-no-hide')) {
                return;
            }
            $('.alert .close').click();
        }, 5000);
    }
};

$(function () {
    FlashMessageUtil.init();
});