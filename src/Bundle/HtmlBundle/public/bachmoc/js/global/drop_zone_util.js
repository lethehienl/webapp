global.DropZoneUtil = {
    init: function (url, successCallback, errorCallback) {
        Dropzone.options.avatarDropzone = {
            url: url,
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 2, // MB
            clicked: true,
            addRemoveLinks: false,
            removedfile: function (file) {
                file.previewElement.remove();
                $('.dz-footer-message').text('');
                $('.dz-footer-message').removeClass('text-danger');
                $('.dz-footer-message').removeClass('text-info');
            },
            maxfilesexceeded: function (file) {
                this.removeAllFiles();
                this.addFile(file);
            },
            acceptedFiles: "image/jpeg, image/jpg, image/png, image/tiff",
            uploadMultiple: false,
            dictDefaultMessage: "Chọn hình ảnh với kích thước dưới 2MB để upload",
            dictInvalidFileType: "Hình đại diện chỉ chấp nhận định dạng jpg, png, tiff",
            dictFileTooBig: "Vui lòng chọn chọn hình ảnh kích thước dưới 2MB",
            dictMaxFilesExceeded: "Vui lòng chỉ chọn 1 hình đại diện",
            error: function(file, message) {
                $(file.previewElement).addClass("dz-error").find('.dz-error-message').text(message);
                $('.dz-footer-message').text(message);
                $('.dz-footer-message').addClass('text-danger');
                $('.dz-footer-message').removeClass('text-info');
            },
            success: function(file, message) {
                $('.dz-footer-message').text('Thay đổi hình đại diện thành công');
                $('.dz-footer-message').addClass('text-info');
                $('.dz-footer-message').removeClass('text-danger');
            },
            init() {
                    this.on('success', function (data) {
                        if (successCallback) {
                            successCallback(data);
                        }
                    })

                    this.on('error', function () {
                        if (errorCallback) {
                            errorCallback();
                        }
                    })
            }
        };
    },
};
