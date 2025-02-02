import {EmployeeList} from './employee_list';

$(function () {
    EmployeeList.init();
});
app.gaAction('ga_update_info', 'Quản lí học viên', 'Cập nhật hồ sơ');
app.gaAction('ga_result', 'Quản lí học viên', 'Xem kết quả học');
app.gaAction('ga_employee_filter', 'Quản lí học viên', 'Lọc_filter');
