import '../sass/loginPage.scss';
import {checkMatchPassword} from '../../../../AppBundle/Resources/public/js/utils/general_utils'

const loginPage = {

    handleCheckReEnterPassword() {

        checkMatchPassword('form[name="reset_password"]', '#reset_password_plainPassword_first', '#reset_password_plainPassword_second');
    },

    togglePassword() {
        let togglePass = $('.toggle-pass');
        let inputPass = togglePass.closest('.form-group').find('input');
        let eyeIcon = 'fa-eye';
        let eyeSlashIcon = 'fa-eye-slash';

        togglePass.on('click', function () {
            if (inputPass.attr('type') == 'password') {
                inputPass.attr('type', 'text');
                $(this).removeClass(eyeIcon).addClass(eyeSlashIcon);
            } else {
                inputPass.attr('type', 'password');
                $(this).removeClass(eyeSlashIcon).addClass(eyeIcon);
            }


        })
    },

    init() {
        this.handleCheckReEnterPassword();
        this.togglePassword();
    }
};

$(document).ready(function () {
    loginPage.init();
});


