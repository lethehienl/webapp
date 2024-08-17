//var SwalCommon = SwalCommon || {};
global.SwalCommon = {
    deleteConfirm: function (title, callback) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            icon: "warning",
            buttons: [
                'Cancel',
                'Yes'
            ],
            dangerMode: true,
            showCancelButton: true,
        }).then(function (isConfirm) {
            if (isConfirm.value) {
                callback();
            }
        })
    },
    deleteConfirmHTML: function (title, callback) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            icon: "warning",
            buttons: [
                'Cancel',
                'Yes'
            ],
            dangerMode: true,
            showCancelButton: true,
        }).then(function (isConfirm) {
            if (isConfirm.value) {
                callback();
            }
        })
    },

    success: function (title) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            type: "success",
            icon: "success",
            timer: 2100
        }).then(function () {
            window.location.reload();
        });
    },

    successCallback: function (title, callback) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            type: "success",
            icon: "success",
            timer: 2100
        }).then(function () {
            if (callback && typeof callback == 'function') {
                callback();
            }
        });
    },

    error: function (title) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            type: "error",
            timer: 2100,
            icon: "warning",
        }).then(function () {
            window.location.reload();
        });
    },

    errorSessionTimeOut: function (title, callback) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            type: "error",
            timer: 6000,
            icon: "warning"
        }).then(function () {
            if (callback && typeof callback == 'function') {
                callback();
            }
        });
    },

    errorNotReload: function (message, callback) {
        swal.fire({
            title: message,
            type: "error",
            icon: "warning",
            timer: 2100
        }).then(function () {
            if (callback && typeof callback == 'function') {
                callback();
            }
        });
    },
    showLoading: function () {
        swal.showLoading();
    },
    stopLoading: function () {
        swal.close();
    },
};