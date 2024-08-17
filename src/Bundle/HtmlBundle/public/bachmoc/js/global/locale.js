global.locale = {
    changeLanguage: function () {
        var localeElement = $('.nav-item-language');

        localeElement.click(function () {
            var language = $(this).attr('data-lang');
            language = language ? language : 'vi';

            var uri = window.location.pathname;
            var data = {path: uri};

            $.ajax({
                url: envUrlPrefix + '/language/change/' + language,
                dataType: 'json',
                method: 'POST',
                data: JSON.stringify(data)
            }).done(function (data) {
                if(data.code != 200) {
                    window.location.href = '/';
                    return;
                }

                if(data.data == null) {
                    window.location.reload();
                    return;
                }

                window.location.href = data.data;
            });
        });
    },

    init: function () {
        this.changeLanguage();
    }
};

$(function () {
    locale.init();
});