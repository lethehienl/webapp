/*import '../sass/app.scss';*/
import {checkMatchPassword} from "./utils/general_utils";
import "./global/common_util";

global.envUrlPrefix = 'dev';

global.app = {

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

            const requestUrl = envUrlPrefix + '/ajx/campaign/' + $('input[name=_csrf_token]').val() + '/register';

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