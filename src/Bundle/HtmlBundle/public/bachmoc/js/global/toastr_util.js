toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "0",
    "hideDuration": "300",
    "timeOut": "10000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

global.Toastr = {
    warning: function (title) {
        toastr.warning(title)
    },

    info: function (title) {
        toastr.info(title)
    },

    success: function (title) {
        toastr.success(title)
    },

    error: function (title) {
        toastr.error(title)
    }
}
