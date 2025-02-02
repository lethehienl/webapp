export function checkMatchPassword(formElement, passwordElement, rePasswordElement) {

    let rePasswordForm = $(formElement);
    let rePassword = $(passwordElement);
    let reEnterPassword = $(rePasswordElement);

    if (rePasswordForm.length == 0) {
        return;
    }

    rePassword.on('input', function () {

        let reNewPasswordValue = reEnterPassword.val();

        if (reNewPasswordValue != '' && $(this).val() !== reNewPasswordValue) {
            rePasswordForm.removeClass('match').addClass('no-match');
        }

        if (reNewPasswordValue != '' && $(this).val() === reNewPasswordValue) {
            rePasswordForm.removeClass('no-match').addClass('match');
        }
    })

    reEnterPassword.on('input', function () {
        let newPasswordValue = rePassword.val();

        if ($(this).val() !== newPasswordValue) {
            rePasswordForm.removeClass('match').addClass('no-match');
        }

        if ($(this).val() === newPasswordValue) {
            rePasswordForm.removeClass('no-match').addClass('match');
        }
    })
}

