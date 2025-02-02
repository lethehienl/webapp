import '../../sass/campaign/campaign.scss'

const campaign = {
    handleAnimation() {
        Pace.on('done', function () {
            $('.integrate-banner').addClass("animated flipInX delay-1s");
        });
    },
    handerSlider() {
        var swiper = new Swiper('.blog-slider', {
            spaceBetween: 30,
            effect: 'fade',
            loop: true,
            mousewheel: {
                invert: false,
            },
            // autoHeight: true,
            pagination: {
                el: '.blog-slider__pagination',
                clickable: true,
            }
        });
    },
    init() {
        this.handleAnimation();
        this.handerSlider();
    }
}

$(document).ready(function () {
    campaign.init();
})