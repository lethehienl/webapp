import '../sass/employeeCourseDetail.scss';
import employeeCourseDetailGrid from './employer/employee_course_detail_grid';

const employeeCourseDetail = {
    detailsAction: function () {
        let employeeId = $('#current-employee-id').val();
        let orderCourseId = $("#current-order-course").val();
        let statusNode = $('.employee-learning-status');

        let updateAction = function (inviteStatus) {
            let inviteActionNode = $('.employee-invite-action');

            let actionHtml = '';

            if (inviteStatus === 1 || inviteStatus === 2) {
                actionHtml = `
                    <a class="btn btn-link text-danger invite-lock-Unlock" data-action-path="/company/course/invitation/lock-or-unlock/2" href="#">Ngừng Kích hoạt</a>
                `;
                inviteActionNode.html(actionHtml);
                statusNode.html('Đang Học');
            }

            if (inviteStatus === 3) {
                actionHtml = `
                    <a class="btn btn-link text-danger invite-lock-Unlock" data-action-path="/company/course/invitation/lock-or-unlock/1" href="#">Kích Hoạt</a>
                `;
                inviteActionNode.html(actionHtml);
                statusNode.html('Vô hiệu hóa');
            }
        };

        $(document).on('click', '.invite-lock-Unlock', function (e) {
            e.preventDefault();
            let self = $(this);
            let url = self.attr("data-action-path");

            let params = JSON.stringify({
                employee_id: employeeId,
                order_course_id: orderCourseId
            });

            AjaxUtil.post(envUrlPrefix + url, params, function (response) {

                if (response.status.code !== 200) {
                    Toastr.error(response.status.message);
                    return;
                }

                Toastr.success(response.status.message);

                let inviteStatus = response.data.status;

                updateAction(inviteStatus);

            }, function (error) {
                Toastr.error(error.toString());
                EmployeeProgressBar.elementState(self, 0);
            }, function () {
                EmployeeProgressBar.elementState(self, 1);
            }, function () {
                EmployeeProgressBar.elementState(self, 0);
            });
        })
    },

    init: function () {
        this.detailsAction();
    }
};

$(document).ready(function () {
    employeeCourseDetail.init();
    employeeCourseDetailGrid.init();
});
