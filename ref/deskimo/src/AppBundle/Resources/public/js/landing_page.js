import '../sass/landingPage.scss'

const landingPage = {
    handleActive() {
        $(".navbar-brand").on("click", function () {
            $(".navbar-nav").find(".active").removeClass("active");
        });
        $(".navbar-nav .nav-link").on("click", function () {
            $(".navbar-nav").find(".active").removeClass("active");
            $(this).addClass("active");
        });
        $(".navbar-toggler").on("click", function () {
            if ($(this).hasClass("actived")) {
                $(this).removeClass("actived");
                return;
            }
            $(this).addClass("actived");
            return;
        });
    },
    scrollToElementAnimate() {
        $('a[href*="#"]').not('a[href="#"]').not('a[href="#0"]').on('click', function (event) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html,body').animate({
                        scrollTop: target.offset().top - 80
                    }, 500, function () {
                        // $('#fullName').setFocus();
                        // var $target = $(target);
                        // $target.focus();
                        // if ($target.is(":focus")) {
                        //     return false;
                        // } else {
                        //     $target.attr('tabindex', '-1');
                        //     $target.focus();
                        // }
                    });
                }
            }
        });

    },
    handleLoginButton() {
        $(document).on('scroll', () => {
            let scroll = $(document).scrollTop();
            if (scroll > 274) {
                $('.login_cta').fadeIn("fast");
            } else {
                $('.login_cta').fadeOut("fast");
            }
            if (scroll >= 30) {
                $('.section-content-1').removeClass('d-none');
                $('.section-content-1').addClass('animated flipInX delay-1s');
            }
        });
    },
    handleValidateFormContact() {
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            let validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    },
    handleSubmitFormContact() {
        $(document).on('submit', '#contactForm', function (e) {
            e.preventDefault();
            let self = $(this);
            let url = envUrlPrefix + '/crm/contact-form/ajax';
            let data = $('#contactForm').serializeArray();
            let dataObject = {};

            $.map(data, function (n, i) {
                let name = n['name'];
                let value = n['value'];
                dataObject[name] = value;

                return dataObject;
            });
            let params = JSON.stringify(dataObject);
            AjaxUtil.post(url, params, function (response) {
                if (response.status.code != 200) {
                    Toastr.error('Không thành công, vui lòng thử lại sau.');
                    return;
                }

                let status = response.data.status;
                // if (status === 'CREATED') {
                Toastr.success('Cảm ơn bạn đã đăng kí nhận tư vấn, chúng tôi sẽ liên hệ trong thời gian sớm nhất.');
                // $('#contactForm').trigger('reset');
                // $('#contactForm').removeClass('was-validated');
                // return;
                // }

                // Toastr.error('Không thành công, vui lòng thử lại sau.');
                $('#contactForm').trigger('reset');
                $('#contactForm').removeClass('was-validated');
            }, function (error) {
                Toastr.error(error.toString());
                $('#btn-contact').removeClass('loading-btn');
                $('#btn-contact').attr('disabled', false);
            }, function () {
                $('#btn-contact').addClass('loading-btn');
                $('#btn-contact').attr('disabled', true);
            }, function () {
                $('#btn-contact').removeClass('loading-btn');
                $('#btn-contact').attr('disabled', false);
            });
        });
    },
    ga: function () {
        app.gaAction('ga_login_header', 'Login_header');
        app.gaAction('ga_login_body', 'Login_body');
    },
    init() {
        this.scrollToElementAnimate();
        this.handleActive();
        this.handleLoginButton();
        this.handleValidateFormContact();
        this.handleSubmitFormContact();
        this.ga();
    }
};

$(document).ready(function () {
    landingPage.init();
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
});


