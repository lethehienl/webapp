exports.learner = {
    handleActiveInviteCode: function () {
        $(document).on('submit', '#active-invite-code-form', function (e) {
            e.preventDefault();
            let self = $(this);
            let inputs = self.find('input');
            let formData = FormUtil.serializeObject(self);
            let submitButton = self.find(':submit');
            EmployeeProgressBar.elementState(0, submitButton);

            let url = envUrlPrefix + '/learner/license-key/active-licence-key-ajax';
            let params = JSON.stringify({
                'token': formData.token,
                'invite_code': formData.invite_code
            });
            AjaxUtil.post(url, params, function (response) {
                if (response.status.code != 200) {
                    Toastr.error(response.status.message);
                    SwalCommon.stopLoading();
                    return;
                }

                //success
                let courseName = response.data.course_name;
                let message = `Kích hoạt thành công khóa học: ${courseName}`;
                Toastr.success(message);

            }, function (error) {
                Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                SwalCommon.stopLoading();
            }, function () {
                //before
                inputs.prop("disabled", true);
                EmployeeProgressBar.elementState(1, submitButton);
                SwalCommon.showLoading();
            }, function () {
                //complete
                inputs.prop("disabled", false);
                EmployeeProgressBar.elementState(0, submitButton);
                SwalCommon.stopLoading();
                $('#active-invite-code-modal').modal('toggle');
            });
        });
    },

    init: function () {
        this.handleActiveInviteCode();
    }
};