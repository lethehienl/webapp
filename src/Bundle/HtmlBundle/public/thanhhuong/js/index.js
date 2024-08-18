var Home = {

    bannerSlider: function () {
        /*$('.bannerSlider').slick({
            autoplay: true,
            speed: 300,
            slidesToShow: 1,
            prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left"></i></div>',
            nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right"></i></div>',
            arrows: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }]
        });*/

        $('.bannerSlider').slick({
            dots: true,
            nav: false,
            arrows: false,
            infinite: true,
            speed: 1200,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            adaptiveHeight: true,
            autoplay: true,
            draggable: false,
            pauseOnFocus: false,
            pauseOnHover: false
        });


        $(".bannerSlider .slick-current").addClass("initialAnimation");
        let transitionSetup = {
            target: ".slick-list",
            enterClass: "u-scale-out",
            doTransition: function() {
                var slideContainer = document.querySelector(this.target);
                slideContainer.classList.add(this.enterClass);
                jQuery(".bannerSlider .slick-current").removeClass("animateIn");
            },
            exitTransition: function() {
                var slideContainer = document.querySelector(this.target);
                setTimeout(() => {
                    slideContainer.classList.remove(this.enterClass);
                    jQuery(".slick-current").addClass("animateIn");
                }, 2000);
            }
        };

        var i = 0;
        // On before slide change
        $(".bannerSlider").on("beforeChange", function(
            event,
            slick,
            currentSlide,
            nextSlide
        ) {
            if (i == 0) {
                event.preventDefault();
                transitionSetup.doTransition();
                i++;
            } else {
                i = 0;
                transitionSetup.exitTransition();
            }

            $(".bannerSlider").slick("slickNext");
            $(".bannerSlider .slick-current").removeClass("initialAnimation");




        });
        $('.bannerSlider').on('afterChange', function(event, slick, currentSlide, nextSlide){
            $( '#banner .smallnav .smallnavItem').removeClass('active');
            $( '#banner .smallnav .smallnavItem'+ currentSlide).addClass('active');
        });

        $('#banner').on("click",".smallnav img",function(){
            var index = $(this).data("index");
            $( '.bannerSlider' ).slick('slickGoTo', index);
        });
    },

    init: function () {

    }
};

/*(function() {
    'use strict';
    Home.bannerSlider();
})();*/
$(document).ready(function () {
    Home.bannerSlider();

});