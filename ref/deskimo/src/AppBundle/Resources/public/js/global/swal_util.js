//var SwalCommon = SwalCommon || {};
global.SwalCommon = {
    deleteConfirm: function (title, callback, complete = null) {
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

            complete && complete();
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

    noteConfirm: function (title, callback, idNote = 'note', complete = null, placeholder = "Nhập ghi chú!", require = false) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            icon: "info",
            html: '<div class="">' +
                '<textarea id="' + idNote + '" class="form-control" placeholder="' + placeholder + '" style="display: flex;"></textarea>' +
                '</div>',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                if (require) {
                    var note = $(`#${idNote}`).val();
                    swal.resetValidationMessage();

                    if (note.length === 0) {
                        swal.showValidationMessage(
                            `${title} không thể để trống`
                        )
                    }
                }
            },
        }).then(function (isConfirm) {
            if (isConfirm.value) {
                callback();
            }

            complete && complete();
        })
    },

    success: function (title, reload = false) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            type: "success",
            icon: "success",
            timer: 2100
        }).then(function () {
            if (reload) {
                window.location.reload();
            }
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

    networkError: function (message, callback) {
        swal.fire({
            title: message,
            type: "error",
            icon: "warning"
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
