import '../sass/learning.scss';
import '../js/global/ajax_util';
import '../js/global/drop_zone_util';
import '../js/global/form_util';
import '../js/global/swal_util';
import '../js/global/flash_message_util';
import '../js/global/datatable_util';
import '../js/global/toastr_util';
import '../js/global/company/employee_progress_bar';
import '../js/global/select2_util';
import {learner} from '../js/learner';

DropZoneUtil.init(envUrlPrefix + '/learning/ajax/avatar', function (data) {
    const avatar = document.querySelector('#user-avatar');
    avatar.setAttribute("src", data.dataURL);
}, function (error) {
    console.log(error);
});

$(function () {
    learner.init();
});

app.gaAction('ga_edit_info', 'Profile', ' Edit_Information');
app.gaAction('ga_edit_avatar', 'Profile', 'Edit_Avatar');