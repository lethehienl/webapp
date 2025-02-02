import '../../sass/employee/employeeInformation.scss';
import {checkMatchPassword} from '../../../../../AppBundle/Resources/public/js/utils/general_utils';

const employeeInformation = {

    handleCheckRePassword() {
        checkMatchPassword('form[name="employer_profile"]', '#employer_profile_password_first', '#employer_profile_password_second');
    },

    init() {
        employeeInformation.handleCheckRePassword();
    }
}

$(document).ready(function () {
    employeeInformation.init();
})
