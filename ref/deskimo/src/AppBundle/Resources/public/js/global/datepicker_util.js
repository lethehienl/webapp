global.DatePickerUtil = {
    init: function () {
        var datePickerElement = $('.datepicker');
        var options = {autoclose: true, disableTouchKeyboard: true};
        var futureOnly = datePickerElement.data('future-only');

        if (futureOnly) {
            var date = new Date();
            date.setDate(date.getDate());
            options.startDate = date;
        }

        datePickerElement.datepicker(options).attr('readonly', 'readonly');
    }
};

$(function () {
    DatePickerUtil.init();
});