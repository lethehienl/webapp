import './components/header';
import '../sass/app.scss';

global.envUrlPrefix = location.href.indexOf('app_dev.php') != -1 ? '/app_dev.php' : '';

global.app = {
  escapeOutput: function (toOutput) {
    return toOutput.replace(/\&/g, '&amp;')
      .replace(/\</g, '&lt;')
      .replace(/\>/g, '&gt;')
      .replace(/\"/g, '&quot;')
      .replace(/\'/g, '&#x27')
      .replace(/\//g, '&#x2F');
  },

  fireTooltip: function () {
    $('[data-toggle="tooltip"]').tooltip();
  },

  fireRipple() {

    if (!$('.ripple').length && !$('.btn').length && !$('.c-sidebar-nav-link').length) {
      return;
    }

    if (this.isIE()) {
      return
    } else {
      $('.ripple').ripple();
      $('.btn').ripple();
      $('.c-sidebar-nav-link').ripple();
    }
  },

  perfectScrollbar() {
    const ps = $('.ps');

    if (ps.length == 0) {
      return;
    }

    ps.each(function () {
      const psAction = new PerfectScrollbar($(this)[0]);
    })
  },

  fireAutoCountAnimation() {
    // If you want to use auto count number *** Need add class 'count-js' & attr data-number='{number}' & value default is 0.
    if ($('.count-js').length == 0 || typeof Pace == "undefined") {
      return;
    }

    Pace.on('done', function () {

      setTimeout(function () {
        $('.count-js').each(function () {
          $(this).prop('Counter', 0).animate({
            Counter: $(this).attr('data-number')
          }, {
            duration: 700,
            easing: "linear",
            step: function (now) {
              // $(this).text(Math.ceil(now));
              $(this).text(Math.round(now * 10) / 10);
            }
          });
        });
      }, 500)
    });
  },

  isIE() {
    var ua = navigator.userAgent;
    /* MSIE used to detect old browsers and Trident used to newer ones*/
    var is_ie = ua.indexOf("MSIE ") > -1 || ua.indexOf("Trident/") > -1;

    return is_ie;
  },

  richTextEditor() {
    $('.rich-text-editor').summernote({
      height: 120,
      toolbar: [
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
      ]
    });
  },

  smartBanner() {
    setInterval(() => {
      if ($('.smartbanner').length > 0) {
        $('.navbar').css("position", "sticky");
        $('.navbar').css("top", "84px");
        $('.banner').css("margin-top", "0");
      } else {
        $('.navbar').css("position", "fixed");
        $('.navbar').css("top", "0");
        $('.banner').css("margin-top", "58px");
      }
    }, 100)
  },

  handleBannerInform() {
    Pace.on('done', () => {
      let isBannerDomainChecked = localStorage.getItem('bannerDomain');
      if (isBannerDomainChecked === null) {
        $('#banner-inform').modal('show');
        localStorage.setItem("bannerDomain", "checked");
      } else {
        return;
      }
    });
  },

  handleScanner() {
    $(document).scannerDetection({
      onComplete(barCode, qty) {
        const url = envUrlPrefix + '/admin/payment/handle-scanner';
        let params = {
          token: barCode
        };

        params = JSON.stringify(params);

        AjaxUtil.post(url, params, function (response) {
          if (response.status.code == 200) {
            SwalCommon.success('Success.. Everything is good!');
            return;
          }

          SwalCommon.errorNotReload('Warning: Something has gone wrong!');
        }, function (error) {
          SwalCommon.errorNotReload('Warning: Something has gone wrong!');
        });
      }
    });
  },

  manualCheckin() {
    $('#checkin-submit').bind('click', function () {
      let valid = this.form.checkValidity();

      if (valid) {
        const url = envUrlPrefix + '/admin/visit/manual-checkin';
        let params = {
          form_token: $('#_token_form').val(),
          code: $('#qr_code_number').val()
        };

        params = JSON.stringify(params);

        AjaxUtil.post(url, params, function (response) {
          if (response.status.code == 200) {
            SwalCommon.success('Success.. Everything is good!');
            return;
          }

          SwalCommon.errorNotReload('Warning: Something has gone wrong!');
        }, function (error) {
          SwalCommon.errorNotReload('Warning: Something has gone wrong!');
        });
      }
    });
  },

  init() {
    this.perfectScrollbar();
    this.fireTooltip();
    this.fireRipple();
    this.fireAutoCountAnimation();
    this.richTextEditor();
    this.handleScanner();
    this.manualCheckin();
  }
}

$(document).ready(function () {
  app.init()
});
