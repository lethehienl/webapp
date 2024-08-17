/*import '../sass/app.scss';*/
/*import {checkMatchPassword} from "./utils/general_utils";*/
/*import "./global/common_util";*/

/*import './form_util.js';
import './ajax_util.js';
import './swal_util.js';
import './flash_message_util.js';
import './locale';*/

function checkMatchPassword(formElement, passwordElement, rePasswordElement) {

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
            rePasswordForm.find('button[type="submit"]').addClass('disabled');
        }

        if (reNewPasswordValue != '' && $(this).val() === reNewPasswordValue) {
            rePasswordForm.removeClass('no-match').addClass('match');
            rePasswordForm.find('button[type="submit"]').removeClass('disabled');
        }
    })

    reEnterPassword.on('input', function () {
        let newPasswordValue = rePassword.val();

        if ($(this).val() !== newPasswordValue) {
            rePasswordForm.removeClass('match').addClass('no-match');
            rePasswordForm.find('button[type="submit"]').addClass('disabled');
        }

        if ($(this).val() === newPasswordValue) {
            rePasswordForm.removeClass('no-match').addClass('match');
            rePasswordForm.find('button[type="submit"]').removeClass('disabled');
        }
    })
}
///////////////
var FormUtil = {
    serializeObject: function(formElement) {
        var o = {};
        var a = $(formElement).serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    },

    validaNumberInput: function() {
        //TODO class: number-only
    }
};

///////////////
var AjaxUtil = {
    post: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        let initObject ={
            url: url,
            type: 'POST',
            data : params,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        };

        $.ajax(initObject);
    },

    postFile: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'POST',
            data : params,
            processData: false,
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    },

    patch: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'PATCH',
            data: params,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    },

    delete: function(url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'DELETE',
            data: params,
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    },

    get: function(url, successCallback, errorCallback, beforeSendCallback, completeCallback) {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend : function() {
                if(beforeSendCallback) {
                    beforeSendCallback();
                }
            },
            complete: function () {
                if(completeCallback) {
                    completeCallback();
                }
            },
            success: function (result) {
                successCallback(result);
            },
            error: function (error) {
                errorCallback(error)
            }
        })
    }
};

///////////////
var SwalCommon = {
    deleteConfirm: function (title, callback) {
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

    success: function (title) {
        $('.modal').modal('hide');
        swal.fire({
            title: title,
            type: "success",
            icon: "success",
            timer: 2100
        }).then(function () {
            window.location.reload();
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
    showLoading: function () {
        swal.showLoading();
    },
    stopLoading: function () {
        swal.close();
    },
};
///////////////
var FlashMessageUtil = {
    init: function() {
        setTimeout( function() {
            $('.alert .close').click();
        }, 5000);
    }
};

$(function() {
    FlashMessageUtil.init();
});

var locale = {
    changeLanguage: function () {
        var localeElement = $('.nav-item-language');

        localeElement.click(function () {
            var language = $(this).attr('data-lang');
            language = language ? language : 'vi';

            var uri = window.location.pathname;
            var data = {path: uri};

            $.ajax({
                url: envUrlPrefix + '/language/change/' + language,
                dataType: 'json',
                method: 'POST',
                data: JSON.stringify(data)
            }).done(function (data) {
                if(data.code != 200) {
                    window.location.href = '/';
                    return;
                }

                if(data.data == null) {
                    window.location.reload();
                    return;
                }

                window.location.href = data.data;
            });
        });
    },

    init: function () {
        this.changeLanguage();
    }
};

$(function () {
    locale.init();
});
/////////////////////////////////////////////

var app = {

    anchorScrollDown() {
        $("a").on('click', function (event) {

            if (this.hash !== "" && $(this.hash).attr('role') != 'tabpanel') {
                console.log(this.hash);
                event.preventDefault();

                var hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 1000, function () {
                    window.location.hash = hash;
                });
            }
        });
    },


    threeSlider: function () {
        $('.threeSlider').slick({
            speed: 300,
            slidesToShow: 3,
            prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right"></i></div>',
            arrows: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    },

    oneSlider: function () {
        $('.oneSlider').slick({
            dots: true,
            speed: 300,
            slidesToShow: 1,
            prevArrow: null,
            nextArrow: null,
            arrows: false,
            dotsClass: 'custom-dots',
            customPaging: function (slider, i) {
                var slideNumber = (i + 1),
                    totalSlides = slider.slideCount;
                return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
            }
        });
    },

    introSlider: function () {
        $('.introSlider').slick({
            speed: 300,
            slidesToShow: 5,
            prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right"></i></div>',
            arrows: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    },

    aboutSlider: function () {
        $('.aboutMainIcon').slick({
            speed: 300,
            slidesToShow: 6,
            prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right"></i></div>',
            arrows: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    },

    moveClouds: function () {
        /* clouds 1 & 2 move to the left
           clouds 3 & 4 to the right
           clouds 5 & 6 to the right */

        var i;
        var topValue;
        var leftValue;
        for (i = 1; i < 7; i++) {
            var cloud = document.getElementById("cloud" + i);

            if (cloud == undefined) {
                return;
            }

            cloud.style.transitionTimingFunction = "ease-out";
            cloud.style.transitionDuration = "700ms";
            var top = window.getComputedStyle(cloud, null).getPropertyValue("top");

            topValue = parseInt(top);
            topValue = topValue - 20;
            top = topValue + "px";

            cloud.style.top = top;

            var left = window.getComputedStyle(cloud, null).getPropertyValue("left");
            leftValue = parseInt(left);

            if (i < 3) {
                leftValue = leftValue - 30;
            } else {
                leftValue = leftValue + 30;
            }
            left = leftValue + "px";

            cloud.style.left = left;

        }
    },

    handleSubmitForm() {
        $("#registration").submit(function(event){
            event.preventDefault();
            var queryDict = {};
            location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]})

            const requestUrl = '/ajx/campaign/' + $('input[name=_csrf_token]').val() + '/register';

            var formData = {
                'full_name': $('input[name=full_name]').val(),
                'email': $('input[name=email]').val(),
                'campaign_id': $('input[name=campaign_id]').val(),
                'phone_number': $('input[name=phone_number]').val(),
                'note': $('input[name=note]').val(),
                'token': $('input[name=_csrf_token]').val(),
                'utm_info': queryDict
            };

            $('#loading-animation').show();

            $.ajax({
                type: 'POST',
                url: requestUrl,
                data: JSON.stringify(formData),
                dataType: 'json',
                contentType: 'application/json',
                encode: true
            })
                .done(function (data) {
                    $('#loading-animation').hide();
                    $("#successModal").modal('show');
                    document.getElementById("registration").reset();
                });
        });
    },

    testimonialSlider: function() {

        $('.testimonialSlider').slick({

            speed: 700,
            slidesToShow: 1,
            arrows: true,
            prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left" aria-hidden="true"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right" aria-hidden="true"></i></div>',
            dots: true,

            dotsClass: 'custom-dots',
            customPaging: function (slider, i) {
                var slideNumber = (i + 1),
                    totalSlides = slider.slideCount;
                return '<a class="dot" role="button" title="' + slideNumber + ' of ' + totalSlides + '"><span class="string">' + slideNumber + '/' + totalSlides + '</span></a>';
            }

        });

        $(".testimonialSlider .aleft").on('click', function (event) {
            $(".testimonialSlider .slick-prev").click();
        });
        $(".testimonialSlider .aright").on('click', function (event) {
            $(".testimonialSlider .slick-next").click();
        });
    },

    init: function () {
        //alert(3);
        this.threeSlider();
        this.oneSlider();
        this.introSlider();
        this.aboutSlider();
        this.anchorScrollDown();
        this.moveClouds();
        this.handleSubmitForm();
        this.testimonialSlider();
    }
}

$(document).ready(function () {
    app.init();
    $(".scheduleMainDay .day p").tooltip();
});