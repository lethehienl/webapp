global.Select2Util = {
    init: function() {
        var options = {
            placeholder: "--Please choose--",
            allowClear: true,
            theme: "bootstrap"
        };

        $('.pure-select2').select2(options);
    }
};

$(function() {
    Select2Util.init();
});
