(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["bachmoc"],{

/***/ "./node_modules/webpack/buildin/global.js":
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/app.js":
/*!***********************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/app.js ***!
  \***********************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(global) {/* harmony import */ var _utils_general_utils__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils/general_utils */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/utils/general_utils.js");
/* harmony import */ var _global_common_util__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./global/common_util */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/common_util.js");
/*import '../sass/app.scss';*/


global.envUrlPrefix = location.href.indexOf('app_dev.php') != -1 ? '/app_dev.php' : '';
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
        var slideNumber = i + 1,
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
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 3
        }
      }, {
        breakpoint: 480,
        settings: {
          slidesToShow: 1
        }
      }]
    });
  },
  aboutSlider: function () {
    $('.aboutMainIcon').slick({
      speed: 300,
      slidesToShow: 6,
      prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left"></i></div>',
      nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right"></i></div>',
      arrows: true,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 3
        }
      }, {
        breakpoint: 480,
        settings: {
          slidesToShow: 1
        }
      }]
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
    $("#registration").submit(function (event) {
      event.preventDefault();
      var queryDict = {};
      location.search.substr(1).split("&").forEach(function (item) {
        queryDict[item.split("=")[0]] = item.split("=")[1];
      });
      var requestUrl = envUrlPrefix + '/ajx/campaign/' + $('input[name=_csrf_token]').val() + '/register';
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
      }).done(function (data) {
        $('#loading-animation').hide();
        $("#successModal").modal('show');
        document.getElementById("registration").reset();
      });
    });
  },
  testimonialSlider: function () {
    $('.testimonialSlider').slick({
      speed: 700,
      slidesToShow: 1,
      arrows: true,
      prevArrow: '<div class="slick-prev"><i class="fas fa-chevron-circle-left" aria-hidden="true"></i></div>',
      nextArrow: '<div class="slick-next"><i class="fas fa-chevron-circle-right" aria-hidden="true"></i></div>',
      dots: true,
      dotsClass: 'custom-dots',
      customPaging: function (slider, i) {
        var slideNumber = i + 1,
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
};
$(document).ready(function () {
  app.init();
  $(".scheduleMainDay .day p").tooltip();
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/ajax_util.js":
/*!************************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/global/ajax_util.js ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {global.AjaxUtil = {
  post: function (url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
    var initObject = {
      url: url,
      type: 'POST',
      data: params,
      beforeSend: function () {
        if (beforeSendCallback) {
          beforeSendCallback();
        }
      },
      complete: function () {
        if (completeCallback) {
          completeCallback();
        }
      },
      success: function (result) {
        successCallback(result);
      },
      error: function (error) {
        errorCallback(error);
      }
    };
    $.ajax(initObject);
  },
  postFile: function (url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
    $.ajax({
      url: url,
      type: 'POST',
      data: params,
      processData: false,
      enctype: 'multipart/form-data',
      contentType: false,
      cache: false,
      beforeSend: function () {
        if (beforeSendCallback) {
          beforeSendCallback();
        }
      },
      complete: function () {
        if (completeCallback) {
          completeCallback();
        }
      },
      success: function (result) {
        successCallback(result);
      },
      error: function (error) {
        errorCallback(error);
      }
    });
  },
  patch: function (url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
    $.ajax({
      url: url,
      type: 'PATCH',
      data: params,
      beforeSend: function () {
        if (beforeSendCallback) {
          beforeSendCallback();
        }
      },
      complete: function () {
        if (completeCallback) {
          completeCallback();
        }
      },
      success: function (result) {
        successCallback(result);
      },
      error: function (error) {
        errorCallback(error);
      }
    });
  },
  delete: function (url, params, successCallback, errorCallback, beforeSendCallback, completeCallback) {
    $.ajax({
      url: url,
      type: 'DELETE',
      data: params,
      beforeSend: function () {
        if (beforeSendCallback) {
          beforeSendCallback();
        }
      },
      complete: function () {
        if (completeCallback) {
          completeCallback();
        }
      },
      success: function (result) {
        successCallback(result);
      },
      error: function (error) {
        errorCallback(error);
      }
    });
  },
  get: function (url, successCallback, errorCallback, beforeSendCallback, completeCallback) {
    $.ajax({
      url: url,
      type: 'GET',
      beforeSend: function () {
        if (beforeSendCallback) {
          beforeSendCallback();
        }
      },
      complete: function () {
        if (completeCallback) {
          completeCallback();
        }
      },
      success: function (result) {
        successCallback(result);
      },
      error: function (error) {
        errorCallback(error);
      }
    });
  }
};
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/common_util.js":
/*!**************************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/global/common_util.js ***!
  \**************************************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _form_util_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./form_util.js */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/form_util.js");
/* harmony import */ var _form_util_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_form_util_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ajax_util_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ajax_util.js */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/ajax_util.js");
/* harmony import */ var _ajax_util_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_ajax_util_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _swal_util_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./swal_util.js */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/swal_util.js");
/* harmony import */ var _swal_util_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_swal_util_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _flash_message_util_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./flash_message_util.js */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/flash_message_util.js");
/* harmony import */ var _flash_message_util_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_flash_message_util_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _locale__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./locale */ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/locale.js");
/* harmony import */ var _locale__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_locale__WEBPACK_IMPORTED_MODULE_4__);





// import './toastr_util';

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/flash_message_util.js":
/*!*********************************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/global/flash_message_util.js ***!
  \*********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {global.FlashMessageUtil = {
  init: function () {
    setTimeout(function () {
      $('.alert .close').click();
    }, 5000);
  }
};
$(function () {
  FlashMessageUtil.init();
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/form_util.js":
/*!************************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/global/form_util.js ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {global.FormUtil = {
  serializeObject: function (formElement) {
    var o = {};
    var a = $(formElement).serializeArray();
    $.each(a, function () {
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
  validaNumberInput: function () {
    //TODO class: number-only
  }
};
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/locale.js":
/*!*********************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/global/locale.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {global.locale = {
  changeLanguage: function () {
    var localeElement = $('.nav-item-language');
    localeElement.click(function () {
      var language = $(this).attr('data-lang');
      language = language ? language : 'vi';
      var uri = window.location.pathname;
      var data = {
        path: uri
      };
      $.ajax({
        url: envUrlPrefix + '/language/change/' + language,
        dataType: 'json',
        method: 'POST',
        data: JSON.stringify(data)
      }).done(function (data) {
        if (data.code != 200) {
          window.location.href = '/';
          return;
        }
        if (data.data == null) {
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
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/global/swal_util.js":
/*!************************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/global/swal_util.js ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {//var SwalCommon = SwalCommon || {};
global.SwalCommon = {
  deleteConfirm: function (title, callback) {
    $('.modal').modal('hide');
    swal.fire({
      title: title,
      icon: "warning",
      buttons: ['Cancel', 'Yes'],
      dangerMode: true,
      showCancelButton: true
    }).then(function (isConfirm) {
      if (isConfirm.value) {
        callback();
      }
    });
  },
  deleteConfirmHTML: function (title, callback) {
    $('.modal').modal('hide');
    swal.fire({
      title: title,
      icon: "warning",
      buttons: ['Cancel', 'Yes'],
      dangerMode: true,
      showCancelButton: true
    }).then(function (isConfirm) {
      if (isConfirm.value) {
        callback();
      }
    });
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
      icon: "warning"
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
  }
};
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./src/AppBundle/Resources/public/front_office/bachmoc/js/utils/general_utils.js":
/*!***************************************************************************************!*\
  !*** ./src/AppBundle/Resources/public/front_office/bachmoc/js/utils/general_utils.js ***!
  \***************************************************************************************/
/*! exports provided: checkMatchPassword */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "checkMatchPassword", function() { return checkMatchPassword; });
function checkMatchPassword(formElement, passwordElement, rePasswordElement) {
  var rePasswordForm = $(formElement);
  var rePassword = $(passwordElement);
  var reEnterPassword = $(rePasswordElement);
  if (rePasswordForm.length == 0) {
    return;
  }
  rePassword.on('input', function () {
    var reNewPasswordValue = reEnterPassword.val();
    if (reNewPasswordValue != '' && $(this).val() !== reNewPasswordValue) {
      rePasswordForm.removeClass('match').addClass('no-match');
      rePasswordForm.find('button[type="submit"]').addClass('disabled');
    }
    if (reNewPasswordValue != '' && $(this).val() === reNewPasswordValue) {
      rePasswordForm.removeClass('no-match').addClass('match');
      rePasswordForm.find('button[type="submit"]').removeClass('disabled');
    }
  });
  reEnterPassword.on('input', function () {
    var newPasswordValue = rePassword.val();
    if ($(this).val() !== newPasswordValue) {
      rePasswordForm.removeClass('match').addClass('no-match');
      rePasswordForm.find('button[type="submit"]').addClass('disabled');
    }
    if ($(this).val() === newPasswordValue) {
      rePasswordForm.removeClass('no-match').addClass('match');
      rePasswordForm.find('button[type="submit"]').removeClass('disabled');
    }
  });
}

/***/ })

},[["./src/AppBundle/Resources/public/front_office/bachmoc/js/app.js","runtime"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vKHdlYnBhY2spL2J1aWxkaW4vZ2xvYmFsLmpzIiwid2VicGFjazovLy8uL3NyYy9BcHBCdW5kbGUvUmVzb3VyY2VzL3B1YmxpYy9mcm9udF9vZmZpY2UvYmFjaG1vYy9qcy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vc3JjL0FwcEJ1bmRsZS9SZXNvdXJjZXMvcHVibGljL2Zyb250X29mZmljZS9iYWNobW9jL2pzL2dsb2JhbC9hamF4X3V0aWwuanMiLCJ3ZWJwYWNrOi8vLy4vc3JjL0FwcEJ1bmRsZS9SZXNvdXJjZXMvcHVibGljL2Zyb250X29mZmljZS9iYWNobW9jL2pzL2dsb2JhbC9jb21tb25fdXRpbC5qcyIsIndlYnBhY2s6Ly8vLi9zcmMvQXBwQnVuZGxlL1Jlc291cmNlcy9wdWJsaWMvZnJvbnRfb2ZmaWNlL2JhY2htb2MvanMvZ2xvYmFsL2ZsYXNoX21lc3NhZ2VfdXRpbC5qcyIsIndlYnBhY2s6Ly8vLi9zcmMvQXBwQnVuZGxlL1Jlc291cmNlcy9wdWJsaWMvZnJvbnRfb2ZmaWNlL2JhY2htb2MvanMvZ2xvYmFsL2Zvcm1fdXRpbC5qcyIsIndlYnBhY2s6Ly8vLi9zcmMvQXBwQnVuZGxlL1Jlc291cmNlcy9wdWJsaWMvZnJvbnRfb2ZmaWNlL2JhY2htb2MvanMvZ2xvYmFsL2xvY2FsZS5qcyIsIndlYnBhY2s6Ly8vLi9zcmMvQXBwQnVuZGxlL1Jlc291cmNlcy9wdWJsaWMvZnJvbnRfb2ZmaWNlL2JhY2htb2MvanMvZ2xvYmFsL3N3YWxfdXRpbC5qcyIsIndlYnBhY2s6Ly8vLi9zcmMvQXBwQnVuZGxlL1Jlc291cmNlcy9wdWJsaWMvZnJvbnRfb2ZmaWNlL2JhY2htb2MvanMvdXRpbHMvZ2VuZXJhbF91dGlscy5qcyJdLCJuYW1lcyI6WyJnbG9iYWwiLCJlbnZVcmxQcmVmaXgiLCJsb2NhdGlvbiIsImhyZWYiLCJpbmRleE9mIiwiYXBwIiwiYW5jaG9yU2Nyb2xsRG93biIsIiQiLCJvbiIsImV2ZW50IiwiaGFzaCIsImF0dHIiLCJjb25zb2xlIiwibG9nIiwicHJldmVudERlZmF1bHQiLCJhbmltYXRlIiwic2Nyb2xsVG9wIiwib2Zmc2V0IiwidG9wIiwid2luZG93IiwidGhyZWVTbGlkZXIiLCJzbGljayIsInNwZWVkIiwic2xpZGVzVG9TaG93IiwicHJldkFycm93IiwibmV4dEFycm93IiwiYXJyb3dzIiwicmVzcG9uc2l2ZSIsImJyZWFrcG9pbnQiLCJzZXR0aW5ncyIsIm9uZVNsaWRlciIsImRvdHMiLCJkb3RzQ2xhc3MiLCJjdXN0b21QYWdpbmciLCJzbGlkZXIiLCJpIiwic2xpZGVOdW1iZXIiLCJ0b3RhbFNsaWRlcyIsInNsaWRlQ291bnQiLCJpbnRyb1NsaWRlciIsImFib3V0U2xpZGVyIiwibW92ZUNsb3VkcyIsInRvcFZhbHVlIiwibGVmdFZhbHVlIiwiY2xvdWQiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwidW5kZWZpbmVkIiwic3R5bGUiLCJ0cmFuc2l0aW9uVGltaW5nRnVuY3Rpb24iLCJ0cmFuc2l0aW9uRHVyYXRpb24iLCJnZXRDb21wdXRlZFN0eWxlIiwiZ2V0UHJvcGVydHlWYWx1ZSIsInBhcnNlSW50IiwibGVmdCIsImhhbmRsZVN1Ym1pdEZvcm0iLCJzdWJtaXQiLCJxdWVyeURpY3QiLCJzZWFyY2giLCJzdWJzdHIiLCJzcGxpdCIsImZvckVhY2giLCJpdGVtIiwicmVxdWVzdFVybCIsInZhbCIsImZvcm1EYXRhIiwic2hvdyIsImFqYXgiLCJ0eXBlIiwidXJsIiwiZGF0YSIsIkpTT04iLCJzdHJpbmdpZnkiLCJkYXRhVHlwZSIsImNvbnRlbnRUeXBlIiwiZW5jb2RlIiwiZG9uZSIsImhpZGUiLCJtb2RhbCIsInJlc2V0IiwidGVzdGltb25pYWxTbGlkZXIiLCJjbGljayIsImluaXQiLCJyZWFkeSIsInRvb2x0aXAiLCJBamF4VXRpbCIsInBvc3QiLCJwYXJhbXMiLCJzdWNjZXNzQ2FsbGJhY2siLCJlcnJvckNhbGxiYWNrIiwiYmVmb3JlU2VuZENhbGxiYWNrIiwiY29tcGxldGVDYWxsYmFjayIsImluaXRPYmplY3QiLCJiZWZvcmVTZW5kIiwiY29tcGxldGUiLCJzdWNjZXNzIiwicmVzdWx0IiwiZXJyb3IiLCJwb3N0RmlsZSIsInByb2Nlc3NEYXRhIiwiZW5jdHlwZSIsImNhY2hlIiwicGF0Y2giLCJkZWxldGUiLCJnZXQiLCJGbGFzaE1lc3NhZ2VVdGlsIiwic2V0VGltZW91dCIsIkZvcm1VdGlsIiwic2VyaWFsaXplT2JqZWN0IiwiZm9ybUVsZW1lbnQiLCJvIiwiYSIsInNlcmlhbGl6ZUFycmF5IiwiZWFjaCIsIm5hbWUiLCJwdXNoIiwidmFsdWUiLCJ2YWxpZGFOdW1iZXJJbnB1dCIsImxvY2FsZSIsImNoYW5nZUxhbmd1YWdlIiwibG9jYWxlRWxlbWVudCIsImxhbmd1YWdlIiwidXJpIiwicGF0aG5hbWUiLCJwYXRoIiwibWV0aG9kIiwiY29kZSIsInJlbG9hZCIsIlN3YWxDb21tb24iLCJkZWxldGVDb25maXJtIiwidGl0bGUiLCJjYWxsYmFjayIsInN3YWwiLCJmaXJlIiwiaWNvbiIsImJ1dHRvbnMiLCJkYW5nZXJNb2RlIiwic2hvd0NhbmNlbEJ1dHRvbiIsInRoZW4iLCJpc0NvbmZpcm0iLCJkZWxldGVDb25maXJtSFRNTCIsInRpbWVyIiwiZXJyb3JTZXNzaW9uVGltZU91dCIsImVycm9yTm90UmVsb2FkIiwibWVzc2FnZSIsInNob3dMb2FkaW5nIiwic3RvcExvYWRpbmciLCJjbG9zZSIsImNoZWNrTWF0Y2hQYXNzd29yZCIsInBhc3N3b3JkRWxlbWVudCIsInJlUGFzc3dvcmRFbGVtZW50IiwicmVQYXNzd29yZEZvcm0iLCJyZVBhc3N3b3JkIiwicmVFbnRlclBhc3N3b3JkIiwibGVuZ3RoIiwicmVOZXdQYXNzd29yZFZhbHVlIiwicmVtb3ZlQ2xhc3MiLCJhZGRDbGFzcyIsImZpbmQiLCJuZXdQYXNzd29yZFZhbHVlIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7QUFBQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQSxDQUFDOztBQUVEO0FBQ0E7QUFDQTtBQUNBLENBQUM7QUFDRDtB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TUFDbEVKLGNBQWMsQ0FBQ0ssV0FBVyxDQUFDLFVBQVUsQ0FBQyxDQUFDQyxRQUFRLENBQUMsT0FBTyxDQUFDO01BQ3hETixjQUFjLENBQUNPLElBQUksQ0FBQyx1QkFBdUIsQ0FBQyxDQUFDRixXQUFXLENBQUMsVUFBVSxDQUFDO0lBQ3hFO0VBQ0osQ0FBQyxDQUFDO0VBRUZILGVBQWUsQ0FBQ2pKLEVBQUUsQ0FBQyxPQUFPLEVBQUUsWUFBWTtJQUNwQyxJQUFJdUosZ0JBQWdCLEdBQUdQLFVBQVUsQ0FBQ3hGLEdBQUcsQ0FBQyxDQUFDO0lBRXZDLElBQUl6RCxDQUFDLENBQUMsSUFBSSxDQUFDLENBQUN5RCxHQUFHLENBQUMsQ0FBQyxLQUFLK0YsZ0JBQWdCLEVBQUU7TUFDcENSLGNBQWMsQ0FBQ0ssV0FBVyxDQUFDLE9BQU8sQ0FBQyxDQUFDQyxRQUFRLENBQUMsVUFBVSxDQUFDO01BQ3hETixjQUFjLENBQUNPLElBQUksQ0FBQyx1QkFBdUIsQ0FBQyxDQUFDRCxRQUFRLENBQUMsVUFBVSxDQUFDO0lBQ3JFO0lBRUEsSUFBSXRKLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ3lELEdBQUcsQ0FBQyxDQUFDLEtBQUsrRixnQkFBZ0IsRUFBRTtNQUNwQ1IsY0FBYyxDQUFDSyxXQUFXLENBQUMsVUFBVSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxPQUFPLENBQUM7TUFDeEROLGNBQWMsQ0FBQ08sSUFBSSxDQUFDLHVCQUF1QixDQUFDLENBQUNGLFdBQVcsQ0FBQyxVQUFVLENBQUM7SUFDeEU7RUFDSixDQUFDLENBQUM7QUFDTixDIiwiZmlsZSI6ImJhY2htb2MuanMiLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgZztcblxuLy8gVGhpcyB3b3JrcyBpbiBub24tc3RyaWN0IG1vZGVcbmcgPSAoZnVuY3Rpb24oKSB7XG5cdHJldHVybiB0aGlzO1xufSkoKTtcblxudHJ5IHtcblx0Ly8gVGhpcyB3b3JrcyBpZiBldmFsIGlzIGFsbG93ZWQgKHNlZSBDU1ApXG5cdGcgPSBnIHx8IG5ldyBGdW5jdGlvbihcInJldHVybiB0aGlzXCIpKCk7XG59IGNhdGNoIChlKSB7XG5cdC8vIFRoaXMgd29ya3MgaWYgdGhlIHdpbmRvdyByZWZlcmVuY2UgaXMgYXZhaWxhYmxlXG5cdGlmICh0eXBlb2Ygd2luZG93ID09PSBcIm9iamVjdFwiKSBnID0gd2luZG93O1xufVxuXG4vLyBnIGNhbiBzdGlsbCBiZSB1bmRlZmluZWQsIGJ1dCBub3RoaW5nIHRvIGRvIGFib3V0IGl0Li4uXG4vLyBXZSByZXR1cm4gdW5kZWZpbmVkLCBpbnN0ZWFkIG9mIG5vdGhpbmcgaGVyZSwgc28gaXQnc1xuLy8gZWFzaWVyIHRvIGhhbmRsZSB0aGlzIGNhc2UuIGlmKCFnbG9iYWwpIHsgLi4ufVxuXG5tb2R1bGUuZXhwb3J0cyA9IGc7XG4iLCIvKmltcG9ydCAnLi4vc2Fzcy9hcHAuc2Nzcyc7Ki9cbmltcG9ydCB7Y2hlY2tNYXRjaFBhc3N3b3JkfSBmcm9tIFwiLi91dGlscy9nZW5lcmFsX3V0aWxzXCI7XG5pbXBvcnQgXCIuL2dsb2JhbC9jb21tb25fdXRpbFwiO1xuXG5nbG9iYWwuZW52VXJsUHJlZml4ID0gbG9jYXRpb24uaHJlZi5pbmRleE9mKCdhcHBfZGV2LnBocCcpICE9IC0xID8gJy9hcHBfZGV2LnBocCcgOiAnJztcblxuZ2xvYmFsLmFwcCA9IHtcblxuICAgIGFuY2hvclNjcm9sbERvd24oKSB7XG4gICAgICAgICQoXCJhXCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChldmVudCkge1xuXG4gICAgICAgICAgICBpZiAodGhpcy5oYXNoICE9PSBcIlwiICYmICQodGhpcy5oYXNoKS5hdHRyKCdyb2xlJykgIT0gJ3RhYnBhbmVsJykge1xuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKHRoaXMuaGFzaCk7XG4gICAgICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICAgICAgICAgIHZhciBoYXNoID0gdGhpcy5oYXNoO1xuXG4gICAgICAgICAgICAgICAgJCgnaHRtbCwgYm9keScpLmFuaW1hdGUoe1xuICAgICAgICAgICAgICAgICAgICBzY3JvbGxUb3A6ICQoaGFzaCkub2Zmc2V0KCkudG9wXG4gICAgICAgICAgICAgICAgfSwgMTAwMCwgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24uaGFzaCA9IGhhc2g7XG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0sXG5cblxuICAgIHRocmVlU2xpZGVyOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJy50aHJlZVNsaWRlcicpLnNsaWNrKHtcbiAgICAgICAgICAgIHNwZWVkOiAzMDAsXG4gICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDMsXG4gICAgICAgICAgICBwcmV2QXJyb3c6ICc8ZGl2IGNsYXNzPVwic2xpY2stcHJldlwiPjxpIGNsYXNzPVwiZmFzIGZhLWNoZXZyb24tY2lyY2xlLWxlZnRcIj48L2k+PC9kaXY+JyxcbiAgICAgICAgICAgIG5leHRBcnJvdzogJzxkaXYgY2xhc3M9XCJzbGljay1uZXh0XCI+PGkgY2xhc3M9XCJmYXMgZmEtY2hldnJvbi1jaXJjbGUtcmlnaHRcIj48L2k+PC9kaXY+JyxcbiAgICAgICAgICAgIGFycm93czogdHJ1ZSxcbiAgICAgICAgICAgIHJlc3BvbnNpdmU6IFtcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDc2OCxcbiAgICAgICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDQ4MCxcbiAgICAgICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgXVxuICAgICAgICB9KTtcbiAgICB9LFxuXG4gICAgb25lU2xpZGVyOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJy5vbmVTbGlkZXInKS5zbGljayh7XG4gICAgICAgICAgICBkb3RzOiB0cnVlLFxuICAgICAgICAgICAgc3BlZWQ6IDMwMCxcbiAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMSxcbiAgICAgICAgICAgIHByZXZBcnJvdzogbnVsbCxcbiAgICAgICAgICAgIG5leHRBcnJvdzogbnVsbCxcbiAgICAgICAgICAgIGFycm93czogZmFsc2UsXG4gICAgICAgICAgICBkb3RzQ2xhc3M6ICdjdXN0b20tZG90cycsXG4gICAgICAgICAgICBjdXN0b21QYWdpbmc6IGZ1bmN0aW9uIChzbGlkZXIsIGkpIHtcbiAgICAgICAgICAgICAgICB2YXIgc2xpZGVOdW1iZXIgPSAoaSArIDEpLFxuICAgICAgICAgICAgICAgICAgICB0b3RhbFNsaWRlcyA9IHNsaWRlci5zbGlkZUNvdW50O1xuICAgICAgICAgICAgICAgIHJldHVybiAnPGEgY2xhc3M9XCJkb3RcIiByb2xlPVwiYnV0dG9uXCIgdGl0bGU9XCInICsgc2xpZGVOdW1iZXIgKyAnIG9mICcgKyB0b3RhbFNsaWRlcyArICdcIj48c3BhbiBjbGFzcz1cInN0cmluZ1wiPicgKyBzbGlkZU51bWJlciArICcvJyArIHRvdGFsU2xpZGVzICsgJzwvc3Bhbj48L2E+JztcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSxcblxuICAgIGludHJvU2xpZGVyOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJy5pbnRyb1NsaWRlcicpLnNsaWNrKHtcbiAgICAgICAgICAgIHNwZWVkOiAzMDAsXG4gICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDUsXG4gICAgICAgICAgICBwcmV2QXJyb3c6ICc8ZGl2IGNsYXNzPVwic2xpY2stcHJldlwiPjxpIGNsYXNzPVwiZmFzIGZhLWNoZXZyb24tY2lyY2xlLWxlZnRcIj48L2k+PC9kaXY+JyxcbiAgICAgICAgICAgIG5leHRBcnJvdzogJzxkaXYgY2xhc3M9XCJzbGljay1uZXh0XCI+PGkgY2xhc3M9XCJmYXMgZmEtY2hldnJvbi1jaXJjbGUtcmlnaHRcIj48L2k+PC9kaXY+JyxcbiAgICAgICAgICAgIGFycm93czogdHJ1ZSxcbiAgICAgICAgICAgIHJlc3BvbnNpdmU6IFtcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDk5MSxcbiAgICAgICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogM1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDQ4MCxcbiAgICAgICAgICAgICAgICAgICAgc2V0dGluZ3M6IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogMVxuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgXVxuICAgICAgICB9KTtcbiAgICB9LFxuXG4gICAgYWJvdXRTbGlkZXI6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCgnLmFib3V0TWFpbkljb24nKS5zbGljayh7XG4gICAgICAgICAgICBzcGVlZDogMzAwLFxuICAgICAgICAgICAgc2xpZGVzVG9TaG93OiA2LFxuICAgICAgICAgICAgcHJldkFycm93OiAnPGRpdiBjbGFzcz1cInNsaWNrLXByZXZcIj48aSBjbGFzcz1cImZhcyBmYS1jaGV2cm9uLWNpcmNsZS1sZWZ0XCI+PC9pPjwvZGl2PicsXG4gICAgICAgICAgICBuZXh0QXJyb3c6ICc8ZGl2IGNsYXNzPVwic2xpY2stbmV4dFwiPjxpIGNsYXNzPVwiZmFzIGZhLWNoZXZyb24tY2lyY2xlLXJpZ2h0XCI+PC9pPjwvZGl2PicsXG4gICAgICAgICAgICBhcnJvd3M6IHRydWUsXG4gICAgICAgICAgICByZXNwb25zaXZlOiBbXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBicmVha3BvaW50OiA5OTEsXG4gICAgICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDNcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICBicmVha3BvaW50OiA0ODAsXG4gICAgICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDFcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIF1cbiAgICAgICAgfSk7XG4gICAgfSxcblxuICAgIG1vdmVDbG91ZHM6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgLyogY2xvdWRzIDEgJiAyIG1vdmUgdG8gdGhlIGxlZnRcbiAgICAgICAgICAgY2xvdWRzIDMgJiA0IHRvIHRoZSByaWdodFxuICAgICAgICAgICBjbG91ZHMgNSAmIDYgdG8gdGhlIHJpZ2h0ICovXG5cbiAgICAgICAgdmFyIGk7XG4gICAgICAgIHZhciB0b3BWYWx1ZTtcbiAgICAgICAgdmFyIGxlZnRWYWx1ZTtcbiAgICAgICAgZm9yIChpID0gMTsgaSA8IDc7IGkrKykge1xuICAgICAgICAgICAgdmFyIGNsb3VkID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJjbG91ZFwiICsgaSk7XG5cbiAgICAgICAgICAgIGlmIChjbG91ZCA9PSB1bmRlZmluZWQpIHtcbiAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGNsb3VkLnN0eWxlLnRyYW5zaXRpb25UaW1pbmdGdW5jdGlvbiA9IFwiZWFzZS1vdXRcIjtcbiAgICAgICAgICAgIGNsb3VkLnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IFwiNzAwbXNcIjtcbiAgICAgICAgICAgIHZhciB0b3AgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShjbG91ZCwgbnVsbCkuZ2V0UHJvcGVydHlWYWx1ZShcInRvcFwiKTtcblxuICAgICAgICAgICAgdG9wVmFsdWUgPSBwYXJzZUludCh0b3ApO1xuICAgICAgICAgICAgdG9wVmFsdWUgPSB0b3BWYWx1ZSAtIDIwO1xuICAgICAgICAgICAgdG9wID0gdG9wVmFsdWUgKyBcInB4XCI7XG5cbiAgICAgICAgICAgIGNsb3VkLnN0eWxlLnRvcCA9IHRvcDtcblxuICAgICAgICAgICAgdmFyIGxlZnQgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShjbG91ZCwgbnVsbCkuZ2V0UHJvcGVydHlWYWx1ZShcImxlZnRcIik7XG4gICAgICAgICAgICBsZWZ0VmFsdWUgPSBwYXJzZUludChsZWZ0KTtcblxuICAgICAgICAgICAgaWYgKGkgPCAzKSB7XG4gICAgICAgICAgICAgICAgbGVmdFZhbHVlID0gbGVmdFZhbHVlIC0gMzA7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICAgIGxlZnRWYWx1ZSA9IGxlZnRWYWx1ZSArIDMwO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgbGVmdCA9IGxlZnRWYWx1ZSArIFwicHhcIjtcblxuICAgICAgICAgICAgY2xvdWQuc3R5bGUubGVmdCA9IGxlZnQ7XG5cbiAgICAgICAgfVxuICAgIH0sXG5cbiAgICBoYW5kbGVTdWJtaXRGb3JtKCkge1xuICAgICAgICAkKFwiI3JlZ2lzdHJhdGlvblwiKS5zdWJtaXQoZnVuY3Rpb24oZXZlbnQpe1xuICAgICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIHZhciBxdWVyeURpY3QgPSB7fTtcbiAgICAgICAgICAgIGxvY2F0aW9uLnNlYXJjaC5zdWJzdHIoMSkuc3BsaXQoXCImXCIpLmZvckVhY2goZnVuY3Rpb24oaXRlbSkge3F1ZXJ5RGljdFtpdGVtLnNwbGl0KFwiPVwiKVswXV0gPSBpdGVtLnNwbGl0KFwiPVwiKVsxXX0pXG5cbiAgICAgICAgICAgIGNvbnN0IHJlcXVlc3RVcmwgPSBlbnZVcmxQcmVmaXggKyAnL2FqeC9jYW1wYWlnbi8nICsgJCgnaW5wdXRbbmFtZT1fY3NyZl90b2tlbl0nKS52YWwoKSArICcvcmVnaXN0ZXInO1xuXG4gICAgICAgICAgICB2YXIgZm9ybURhdGEgPSB7XG4gICAgICAgICAgICAgICAgJ2Z1bGxfbmFtZSc6ICQoJ2lucHV0W25hbWU9ZnVsbF9uYW1lXScpLnZhbCgpLFxuICAgICAgICAgICAgICAgICdlbWFpbCc6ICQoJ2lucHV0W25hbWU9ZW1haWxdJykudmFsKCksXG4gICAgICAgICAgICAgICAgJ2NhbXBhaWduX2lkJzogJCgnaW5wdXRbbmFtZT1jYW1wYWlnbl9pZF0nKS52YWwoKSxcbiAgICAgICAgICAgICAgICAncGhvbmVfbnVtYmVyJzogJCgnaW5wdXRbbmFtZT1waG9uZV9udW1iZXJdJykudmFsKCksXG4gICAgICAgICAgICAgICAgJ25vdGUnOiAkKCdpbnB1dFtuYW1lPW5vdGVdJykudmFsKCksXG4gICAgICAgICAgICAgICAgJ3Rva2VuJzogJCgnaW5wdXRbbmFtZT1fY3NyZl90b2tlbl0nKS52YWwoKSxcbiAgICAgICAgICAgICAgICAndXRtX2luZm8nOiBxdWVyeURpY3RcbiAgICAgICAgICAgIH07XG5cbiAgICAgICAgICAgICQoJyNsb2FkaW5nLWFuaW1hdGlvbicpLnNob3coKTtcblxuICAgICAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgICAgICB0eXBlOiAnUE9TVCcsXG4gICAgICAgICAgICAgICAgdXJsOiByZXF1ZXN0VXJsLFxuICAgICAgICAgICAgICAgIGRhdGE6IEpTT04uc3RyaW5naWZ5KGZvcm1EYXRhKSxcbiAgICAgICAgICAgICAgICBkYXRhVHlwZTogJ2pzb24nLFxuICAgICAgICAgICAgICAgIGNvbnRlbnRUeXBlOiAnYXBwbGljYXRpb24vanNvbicsXG4gICAgICAgICAgICAgICAgZW5jb2RlOiB0cnVlXG4gICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIC5kb25lKGZ1bmN0aW9uIChkYXRhKSB7XG4gICAgICAgICAgICAgICAgICAgICQoJyNsb2FkaW5nLWFuaW1hdGlvbicpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICAgICAgJChcIiNzdWNjZXNzTW9kYWxcIikubW9kYWwoJ3Nob3cnKTtcbiAgICAgICAgICAgICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJyZWdpc3RyYXRpb25cIikucmVzZXQoKTtcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfSxcblxuICAgIHRlc3RpbW9uaWFsU2xpZGVyOiBmdW5jdGlvbigpIHtcblxuICAgICAgICAkKCcudGVzdGltb25pYWxTbGlkZXInKS5zbGljayh7XG5cbiAgICAgICAgICAgIHNwZWVkOiA3MDAsXG4gICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXG4gICAgICAgICAgICBhcnJvd3M6IHRydWUsXG4gICAgICAgICAgICBwcmV2QXJyb3c6ICc8ZGl2IGNsYXNzPVwic2xpY2stcHJldlwiPjxpIGNsYXNzPVwiZmFzIGZhLWNoZXZyb24tY2lyY2xlLWxlZnRcIiBhcmlhLWhpZGRlbj1cInRydWVcIj48L2k+PC9kaXY+JyxcbiAgICAgICAgICAgIG5leHRBcnJvdzogJzxkaXYgY2xhc3M9XCJzbGljay1uZXh0XCI+PGkgY2xhc3M9XCJmYXMgZmEtY2hldnJvbi1jaXJjbGUtcmlnaHRcIiBhcmlhLWhpZGRlbj1cInRydWVcIj48L2k+PC9kaXY+JyxcbiAgICAgICAgICAgIGRvdHM6IHRydWUsXG5cbiAgICAgICAgICAgIGRvdHNDbGFzczogJ2N1c3RvbS1kb3RzJyxcbiAgICAgICAgICAgIGN1c3RvbVBhZ2luZzogZnVuY3Rpb24gKHNsaWRlciwgaSkge1xuICAgICAgICAgICAgICAgIHZhciBzbGlkZU51bWJlciA9IChpICsgMSksXG4gICAgICAgICAgICAgICAgICAgIHRvdGFsU2xpZGVzID0gc2xpZGVyLnNsaWRlQ291bnQ7XG4gICAgICAgICAgICAgICAgcmV0dXJuICc8YSBjbGFzcz1cImRvdFwiIHJvbGU9XCJidXR0b25cIiB0aXRsZT1cIicgKyBzbGlkZU51bWJlciArICcgb2YgJyArIHRvdGFsU2xpZGVzICsgJ1wiPjxzcGFuIGNsYXNzPVwic3RyaW5nXCI+JyArIHNsaWRlTnVtYmVyICsgJy8nICsgdG90YWxTbGlkZXMgKyAnPC9zcGFuPjwvYT4nO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoXCIudGVzdGltb25pYWxTbGlkZXIgLmFsZWZ0XCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgJChcIi50ZXN0aW1vbmlhbFNsaWRlciAuc2xpY2stcHJldlwiKS5jbGljaygpO1xuICAgICAgICB9KTtcbiAgICAgICAgJChcIi50ZXN0aW1vbmlhbFNsaWRlciAuYXJpZ2h0XCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgJChcIi50ZXN0aW1vbmlhbFNsaWRlciAuc2xpY2stbmV4dFwiKS5jbGljaygpO1xuICAgICAgICB9KTtcbiAgICB9LFxuXG4gICAgaW5pdDogZnVuY3Rpb24gKCkge1xuICAgICAgICAvL2FsZXJ0KDMpO1xuICAgICAgICB0aGlzLnRocmVlU2xpZGVyKCk7XG4gICAgICAgIHRoaXMub25lU2xpZGVyKCk7XG4gICAgICAgIHRoaXMuaW50cm9TbGlkZXIoKTtcbiAgICAgICAgdGhpcy5hYm91dFNsaWRlcigpO1xuICAgICAgICB0aGlzLmFuY2hvclNjcm9sbERvd24oKTtcbiAgICAgICAgdGhpcy5tb3ZlQ2xvdWRzKCk7XG4gICAgICAgIHRoaXMuaGFuZGxlU3VibWl0Rm9ybSgpO1xuICAgICAgICB0aGlzLnRlc3RpbW9uaWFsU2xpZGVyKCk7XG4gICAgfVxufVxuXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG4gICAgYXBwLmluaXQoKTtcbiAgICAkKFwiLnNjaGVkdWxlTWFpbkRheSAuZGF5IHBcIikudG9vbHRpcCgpO1xufSk7IiwiZ2xvYmFsLkFqYXhVdGlsID0ge1xuICAgIHBvc3Q6IGZ1bmN0aW9uKHVybCwgcGFyYW1zLCBzdWNjZXNzQ2FsbGJhY2ssIGVycm9yQ2FsbGJhY2ssIGJlZm9yZVNlbmRDYWxsYmFjaywgY29tcGxldGVDYWxsYmFjaykge1xuICAgICAgICBsZXQgaW5pdE9iamVjdCA9e1xuICAgICAgICAgICAgdXJsOiB1cmwsXG4gICAgICAgICAgICB0eXBlOiAnUE9TVCcsXG4gICAgICAgICAgICBkYXRhIDogcGFyYW1zLFxuICAgICAgICAgICAgYmVmb3JlU2VuZCA6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIGlmKGJlZm9yZVNlbmRDYWxsYmFjaykge1xuICAgICAgICAgICAgICAgICAgICBiZWZvcmVTZW5kQ2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgY29tcGxldGU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBpZihjb21wbGV0ZUNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgICAgIGNvbXBsZXRlQ2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlc3VsdCkge1xuICAgICAgICAgICAgICAgIHN1Y2Nlc3NDYWxsYmFjayhyZXN1bHQpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbiAoZXJyb3IpIHtcbiAgICAgICAgICAgICAgICBlcnJvckNhbGxiYWNrKGVycm9yKVxuICAgICAgICAgICAgfVxuICAgICAgICB9O1xuXG4gICAgICAgICQuYWpheChpbml0T2JqZWN0KTtcbiAgICB9LFxuXG4gICAgcG9zdEZpbGU6IGZ1bmN0aW9uKHVybCwgcGFyYW1zLCBzdWNjZXNzQ2FsbGJhY2ssIGVycm9yQ2FsbGJhY2ssIGJlZm9yZVNlbmRDYWxsYmFjaywgY29tcGxldGVDYWxsYmFjaykge1xuICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgdXJsOiB1cmwsXG4gICAgICAgICAgICB0eXBlOiAnUE9TVCcsXG4gICAgICAgICAgICBkYXRhIDogcGFyYW1zLFxuICAgICAgICAgICAgcHJvY2Vzc0RhdGE6IGZhbHNlLFxuICAgICAgICAgICAgZW5jdHlwZTogJ211bHRpcGFydC9mb3JtLWRhdGEnLFxuICAgICAgICAgICAgY29udGVudFR5cGU6IGZhbHNlLFxuICAgICAgICAgICAgY2FjaGU6IGZhbHNlLFxuICAgICAgICAgICAgYmVmb3JlU2VuZCA6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIGlmKGJlZm9yZVNlbmRDYWxsYmFjaykge1xuICAgICAgICAgICAgICAgICAgICBiZWZvcmVTZW5kQ2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgY29tcGxldGU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBpZihjb21wbGV0ZUNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgICAgIGNvbXBsZXRlQ2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlc3VsdCkge1xuICAgICAgICAgICAgICAgIHN1Y2Nlc3NDYWxsYmFjayhyZXN1bHQpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbiAoZXJyb3IpIHtcbiAgICAgICAgICAgICAgICBlcnJvckNhbGxiYWNrKGVycm9yKVxuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgIH0sXG5cbiAgICBwYXRjaDogZnVuY3Rpb24odXJsLCBwYXJhbXMsIHN1Y2Nlc3NDYWxsYmFjaywgZXJyb3JDYWxsYmFjaywgYmVmb3JlU2VuZENhbGxiYWNrLCBjb21wbGV0ZUNhbGxiYWNrKSB7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IHVybCxcbiAgICAgICAgICAgIHR5cGU6ICdQQVRDSCcsXG4gICAgICAgICAgICBkYXRhOiBwYXJhbXMsXG4gICAgICAgICAgICBiZWZvcmVTZW5kIDogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgaWYoYmVmb3JlU2VuZENhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgICAgIGJlZm9yZVNlbmRDYWxsYmFjaygpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBjb21wbGV0ZTogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIGlmKGNvbXBsZXRlQ2FsbGJhY2spIHtcbiAgICAgICAgICAgICAgICAgICAgY29tcGxldGVDYWxsYmFjaygpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAocmVzdWx0KSB7XG4gICAgICAgICAgICAgICAgc3VjY2Vzc0NhbGxiYWNrKHJlc3VsdCk7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uIChlcnJvcikge1xuICAgICAgICAgICAgICAgIGVycm9yQ2FsbGJhY2soZXJyb3IpXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgfSxcblxuICAgIGRlbGV0ZTogZnVuY3Rpb24odXJsLCBwYXJhbXMsIHN1Y2Nlc3NDYWxsYmFjaywgZXJyb3JDYWxsYmFjaywgYmVmb3JlU2VuZENhbGxiYWNrLCBjb21wbGV0ZUNhbGxiYWNrKSB7XG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IHVybCxcbiAgICAgICAgICAgIHR5cGU6ICdERUxFVEUnLFxuICAgICAgICAgICAgZGF0YTogcGFyYW1zLFxuICAgICAgICAgICAgYmVmb3JlU2VuZCA6IGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgICAgIGlmKGJlZm9yZVNlbmRDYWxsYmFjaykge1xuICAgICAgICAgICAgICAgICAgICBiZWZvcmVTZW5kQ2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgY29tcGxldGU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBpZihjb21wbGV0ZUNhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgICAgIGNvbXBsZXRlQ2FsbGJhY2soKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24gKHJlc3VsdCkge1xuICAgICAgICAgICAgICAgIHN1Y2Nlc3NDYWxsYmFjayhyZXN1bHQpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbiAoZXJyb3IpIHtcbiAgICAgICAgICAgICAgICBlcnJvckNhbGxiYWNrKGVycm9yKVxuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgIH0sXG5cbiAgICBnZXQ6IGZ1bmN0aW9uKHVybCwgc3VjY2Vzc0NhbGxiYWNrLCBlcnJvckNhbGxiYWNrLCBiZWZvcmVTZW5kQ2FsbGJhY2ssIGNvbXBsZXRlQ2FsbGJhY2spIHtcbiAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgIHVybDogdXJsLFxuICAgICAgICAgICAgdHlwZTogJ0dFVCcsXG4gICAgICAgICAgICBiZWZvcmVTZW5kIDogZnVuY3Rpb24oKSB7XG4gICAgICAgICAgICAgICAgaWYoYmVmb3JlU2VuZENhbGxiYWNrKSB7XG4gICAgICAgICAgICAgICAgICAgIGJlZm9yZVNlbmRDYWxsYmFjaygpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBjb21wbGV0ZTogZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIGlmKGNvbXBsZXRlQ2FsbGJhY2spIHtcbiAgICAgICAgICAgICAgICAgICAgY29tcGxldGVDYWxsYmFjaygpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAocmVzdWx0KSB7XG4gICAgICAgICAgICAgICAgc3VjY2Vzc0NhbGxiYWNrKHJlc3VsdCk7XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uIChlcnJvcikge1xuICAgICAgICAgICAgICAgIGVycm9yQ2FsbGJhY2soZXJyb3IpXG4gICAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgfVxufTtcbiIsImltcG9ydCAnLi9mb3JtX3V0aWwuanMnO1xuaW1wb3J0ICcuL2FqYXhfdXRpbC5qcyc7XG5pbXBvcnQgJy4vc3dhbF91dGlsLmpzJztcbmltcG9ydCAnLi9mbGFzaF9tZXNzYWdlX3V0aWwuanMnO1xuaW1wb3J0ICcuL2xvY2FsZSc7XG4vLyBpbXBvcnQgJy4vdG9hc3RyX3V0aWwnO1xuIiwiZ2xvYmFsLkZsYXNoTWVzc2FnZVV0aWwgPSB7XG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XG4gICAgICAgIHNldFRpbWVvdXQoIGZ1bmN0aW9uKCkge1xuICAgICAgICAgICAgJCgnLmFsZXJ0IC5jbG9zZScpLmNsaWNrKCk7XG4gICAgICAgIH0sIDUwMDApO1xuICAgIH1cbn07XG5cbiQoZnVuY3Rpb24oKSB7XG4gICAgRmxhc2hNZXNzYWdlVXRpbC5pbml0KCk7XG59KTsiLCJnbG9iYWwuRm9ybVV0aWwgPSB7XG4gICAgc2VyaWFsaXplT2JqZWN0OiBmdW5jdGlvbihmb3JtRWxlbWVudCkge1xuICAgICAgICB2YXIgbyA9IHt9O1xuICAgICAgICB2YXIgYSA9ICQoZm9ybUVsZW1lbnQpLnNlcmlhbGl6ZUFycmF5KCk7XG4gICAgICAgICQuZWFjaChhLCBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIGlmIChvW3RoaXMubmFtZV0gIT09IHVuZGVmaW5lZCkge1xuICAgICAgICAgICAgICAgIGlmICghb1t0aGlzLm5hbWVdLnB1c2gpIHtcbiAgICAgICAgICAgICAgICAgICAgb1t0aGlzLm5hbWVdID0gW29bdGhpcy5uYW1lXV07XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIG9bdGhpcy5uYW1lXS5wdXNoKHRoaXMudmFsdWUgfHwgJycpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBvW3RoaXMubmFtZV0gPSB0aGlzLnZhbHVlIHx8ICcnO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICAgICAgcmV0dXJuIG87XG4gICAgfSxcblxuICAgIHZhbGlkYU51bWJlcklucHV0OiBmdW5jdGlvbigpIHtcbiAgICAgICAgLy9UT0RPIGNsYXNzOiBudW1iZXItb25seVxuICAgIH1cbn07XG4iLCJnbG9iYWwubG9jYWxlID0ge1xuICAgIGNoYW5nZUxhbmd1YWdlOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHZhciBsb2NhbGVFbGVtZW50ID0gJCgnLm5hdi1pdGVtLWxhbmd1YWdlJyk7XG5cbiAgICAgICAgbG9jYWxlRWxlbWVudC5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgbGFuZ3VhZ2UgPSAkKHRoaXMpLmF0dHIoJ2RhdGEtbGFuZycpO1xuICAgICAgICAgICAgbGFuZ3VhZ2UgPSBsYW5ndWFnZSA/IGxhbmd1YWdlIDogJ3ZpJztcblxuICAgICAgICAgICAgdmFyIHVyaSA9IHdpbmRvdy5sb2NhdGlvbi5wYXRobmFtZTtcbiAgICAgICAgICAgIHZhciBkYXRhID0ge3BhdGg6IHVyaX07XG5cbiAgICAgICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICAgICAgdXJsOiBlbnZVcmxQcmVmaXggKyAnL2xhbmd1YWdlL2NoYW5nZS8nICsgbGFuZ3VhZ2UsXG4gICAgICAgICAgICAgICAgZGF0YVR5cGU6ICdqc29uJyxcbiAgICAgICAgICAgICAgICBtZXRob2Q6ICdQT1NUJyxcbiAgICAgICAgICAgICAgICBkYXRhOiBKU09OLnN0cmluZ2lmeShkYXRhKVxuICAgICAgICAgICAgfSkuZG9uZShmdW5jdGlvbiAoZGF0YSkge1xuICAgICAgICAgICAgICAgIGlmKGRhdGEuY29kZSAhPSAyMDApIHtcbiAgICAgICAgICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uLmhyZWYgPSAnLyc7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBpZihkYXRhLmRhdGEgPT0gbnVsbCkge1xuICAgICAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24ucmVsb2FkKCk7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24uaHJlZiA9IGRhdGEuZGF0YTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9KTtcbiAgICB9LFxuXG4gICAgaW5pdDogZnVuY3Rpb24gKCkge1xuICAgICAgICB0aGlzLmNoYW5nZUxhbmd1YWdlKCk7XG4gICAgfVxufTtcblxuJChmdW5jdGlvbiAoKSB7XG4gICAgbG9jYWxlLmluaXQoKTtcbn0pOyIsIi8vdmFyIFN3YWxDb21tb24gPSBTd2FsQ29tbW9uIHx8IHt9O1xuZ2xvYmFsLlN3YWxDb21tb24gPSB7XG4gICAgZGVsZXRlQ29uZmlybTogZnVuY3Rpb24gKHRpdGxlLCBjYWxsYmFjaykge1xuICAgICAgICAkKCcubW9kYWwnKS5tb2RhbCgnaGlkZScpO1xuICAgICAgICBzd2FsLmZpcmUoe1xuICAgICAgICAgICAgdGl0bGU6IHRpdGxlLFxuICAgICAgICAgICAgaWNvbjogXCJ3YXJuaW5nXCIsXG4gICAgICAgICAgICBidXR0b25zOiBbXG4gICAgICAgICAgICAgICAgJ0NhbmNlbCcsXG4gICAgICAgICAgICAgICAgJ1llcydcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICBkYW5nZXJNb2RlOiB0cnVlLFxuICAgICAgICAgICAgc2hvd0NhbmNlbEJ1dHRvbjogdHJ1ZSxcbiAgICAgICAgfSkudGhlbihmdW5jdGlvbiAoaXNDb25maXJtKSB7XG4gICAgICAgICAgICBpZiAoaXNDb25maXJtLnZhbHVlKSB7XG4gICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSlcbiAgICB9LFxuICAgIGRlbGV0ZUNvbmZpcm1IVE1MOiBmdW5jdGlvbiAodGl0bGUsIGNhbGxiYWNrKSB7XG4gICAgICAgICQoJy5tb2RhbCcpLm1vZGFsKCdoaWRlJyk7XG4gICAgICAgIHN3YWwuZmlyZSh7XG4gICAgICAgICAgICB0aXRsZTogdGl0bGUsXG4gICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIixcbiAgICAgICAgICAgIGJ1dHRvbnM6IFtcbiAgICAgICAgICAgICAgICAnQ2FuY2VsJyxcbiAgICAgICAgICAgICAgICAnWWVzJ1xuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIGRhbmdlck1vZGU6IHRydWUsXG4gICAgICAgICAgICBzaG93Q2FuY2VsQnV0dG9uOiB0cnVlLFxuICAgICAgICB9KS50aGVuKGZ1bmN0aW9uIChpc0NvbmZpcm0pIHtcbiAgICAgICAgICAgIGlmIChpc0NvbmZpcm0udmFsdWUpIHtcbiAgICAgICAgICAgICAgICBjYWxsYmFjaygpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KVxuICAgIH0sXG5cbiAgICBzdWNjZXNzOiBmdW5jdGlvbiAodGl0bGUpIHtcbiAgICAgICAgJCgnLm1vZGFsJykubW9kYWwoJ2hpZGUnKTtcbiAgICAgICAgc3dhbC5maXJlKHtcbiAgICAgICAgICAgIHRpdGxlOiB0aXRsZSxcbiAgICAgICAgICAgIHR5cGU6IFwic3VjY2Vzc1wiLFxuICAgICAgICAgICAgaWNvbjogXCJzdWNjZXNzXCIsXG4gICAgICAgICAgICB0aW1lcjogMjEwMFxuICAgICAgICB9KS50aGVuKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHdpbmRvdy5sb2NhdGlvbi5yZWxvYWQoKTtcbiAgICAgICAgfSk7XG4gICAgfSxcblxuICAgIHN1Y2Nlc3NDYWxsYmFjazogZnVuY3Rpb24gKHRpdGxlLCBjYWxsYmFjaykge1xuICAgICAgICAkKCcubW9kYWwnKS5tb2RhbCgnaGlkZScpO1xuICAgICAgICBzd2FsLmZpcmUoe1xuICAgICAgICAgICAgdGl0bGU6IHRpdGxlLFxuICAgICAgICAgICAgdHlwZTogXCJzdWNjZXNzXCIsXG4gICAgICAgICAgICBpY29uOiBcInN1Y2Nlc3NcIixcbiAgICAgICAgICAgIHRpbWVyOiAyMTAwXG4gICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgaWYgKGNhbGxiYWNrICYmIHR5cGVvZiBjYWxsYmFjayA9PSAnZnVuY3Rpb24nKSB7XG4gICAgICAgICAgICAgICAgY2FsbGJhY2soKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgfSxcblxuICAgIGVycm9yOiBmdW5jdGlvbiAodGl0bGUpIHtcbiAgICAgICAgJCgnLm1vZGFsJykubW9kYWwoJ2hpZGUnKTtcbiAgICAgICAgc3dhbC5maXJlKHtcbiAgICAgICAgICAgIHRpdGxlOiB0aXRsZSxcbiAgICAgICAgICAgIHR5cGU6IFwiZXJyb3JcIixcbiAgICAgICAgICAgIHRpbWVyOiAyMTAwLFxuICAgICAgICAgICAgaWNvbjogXCJ3YXJuaW5nXCIsXG4gICAgICAgIH0pLnRoZW4oZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgd2luZG93LmxvY2F0aW9uLnJlbG9hZCgpO1xuICAgICAgICB9KTtcbiAgICB9LFxuXG4gICAgZXJyb3JTZXNzaW9uVGltZU91dDogZnVuY3Rpb24gKHRpdGxlLCBjYWxsYmFjaykge1xuICAgICAgICAkKCcubW9kYWwnKS5tb2RhbCgnaGlkZScpO1xuICAgICAgICBzd2FsLmZpcmUoe1xuICAgICAgICAgICAgdGl0bGU6IHRpdGxlLFxuICAgICAgICAgICAgdHlwZTogXCJlcnJvclwiLFxuICAgICAgICAgICAgdGltZXI6IDYwMDAsXG4gICAgICAgICAgICBpY29uOiBcIndhcm5pbmdcIlxuICAgICAgICB9KS50aGVuKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmIChjYWxsYmFjayAmJiB0eXBlb2YgY2FsbGJhY2sgPT0gJ2Z1bmN0aW9uJykge1xuICAgICAgICAgICAgICAgIGNhbGxiYWNrKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgIH0sXG5cbiAgICBlcnJvck5vdFJlbG9hZDogZnVuY3Rpb24gKG1lc3NhZ2UsIGNhbGxiYWNrKSB7XG4gICAgICAgIHN3YWwuZmlyZSh7XG4gICAgICAgICAgICB0aXRsZTogbWVzc2FnZSxcbiAgICAgICAgICAgIHR5cGU6IFwiZXJyb3JcIixcbiAgICAgICAgICAgIGljb246IFwid2FybmluZ1wiLFxuICAgICAgICAgICAgdGltZXI6IDIxMDBcbiAgICAgICAgfSkudGhlbihmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZiAoY2FsbGJhY2sgJiYgdHlwZW9mIGNhbGxiYWNrID09ICdmdW5jdGlvbicpIHtcbiAgICAgICAgICAgICAgICBjYWxsYmFjaygpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICB9LFxuICAgIHNob3dMb2FkaW5nOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHN3YWwuc2hvd0xvYWRpbmcoKTtcbiAgICB9LFxuICAgIHN0b3BMb2FkaW5nOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHN3YWwuY2xvc2UoKTtcbiAgICB9LFxufTsiLCJleHBvcnQgZnVuY3Rpb24gY2hlY2tNYXRjaFBhc3N3b3JkKGZvcm1FbGVtZW50LCBwYXNzd29yZEVsZW1lbnQsIHJlUGFzc3dvcmRFbGVtZW50KSB7XG5cbiAgICBsZXQgcmVQYXNzd29yZEZvcm0gPSAkKGZvcm1FbGVtZW50KTtcbiAgICBsZXQgcmVQYXNzd29yZCA9ICQocGFzc3dvcmRFbGVtZW50KTtcbiAgICBsZXQgcmVFbnRlclBhc3N3b3JkID0gJChyZVBhc3N3b3JkRWxlbWVudCk7XG5cbiAgICBpZiAocmVQYXNzd29yZEZvcm0ubGVuZ3RoID09IDApIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIHJlUGFzc3dvcmQub24oJ2lucHV0JywgZnVuY3Rpb24gKCkge1xuXG4gICAgICAgIGxldCByZU5ld1Bhc3N3b3JkVmFsdWUgPSByZUVudGVyUGFzc3dvcmQudmFsKCk7XG5cbiAgICAgICAgaWYgKHJlTmV3UGFzc3dvcmRWYWx1ZSAhPSAnJyAmJiAkKHRoaXMpLnZhbCgpICE9PSByZU5ld1Bhc3N3b3JkVmFsdWUpIHtcbiAgICAgICAgICAgIHJlUGFzc3dvcmRGb3JtLnJlbW92ZUNsYXNzKCdtYXRjaCcpLmFkZENsYXNzKCduby1tYXRjaCcpO1xuICAgICAgICAgICAgcmVQYXNzd29yZEZvcm0uZmluZCgnYnV0dG9uW3R5cGU9XCJzdWJtaXRcIl0nKS5hZGRDbGFzcygnZGlzYWJsZWQnKTtcbiAgICAgICAgfVxuXG4gICAgICAgIGlmIChyZU5ld1Bhc3N3b3JkVmFsdWUgIT0gJycgJiYgJCh0aGlzKS52YWwoKSA9PT0gcmVOZXdQYXNzd29yZFZhbHVlKSB7XG4gICAgICAgICAgICByZVBhc3N3b3JkRm9ybS5yZW1vdmVDbGFzcygnbm8tbWF0Y2gnKS5hZGRDbGFzcygnbWF0Y2gnKTtcbiAgICAgICAgICAgIHJlUGFzc3dvcmRGb3JtLmZpbmQoJ2J1dHRvblt0eXBlPVwic3VibWl0XCJdJykucmVtb3ZlQ2xhc3MoJ2Rpc2FibGVkJyk7XG4gICAgICAgIH1cbiAgICB9KVxuXG4gICAgcmVFbnRlclBhc3N3b3JkLm9uKCdpbnB1dCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgbGV0IG5ld1Bhc3N3b3JkVmFsdWUgPSByZVBhc3N3b3JkLnZhbCgpO1xuXG4gICAgICAgIGlmICgkKHRoaXMpLnZhbCgpICE9PSBuZXdQYXNzd29yZFZhbHVlKSB7XG4gICAgICAgICAgICByZVBhc3N3b3JkRm9ybS5yZW1vdmVDbGFzcygnbWF0Y2gnKS5hZGRDbGFzcygnbm8tbWF0Y2gnKTtcbiAgICAgICAgICAgIHJlUGFzc3dvcmRGb3JtLmZpbmQoJ2J1dHRvblt0eXBlPVwic3VibWl0XCJdJykuYWRkQ2xhc3MoJ2Rpc2FibGVkJyk7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoJCh0aGlzKS52YWwoKSA9PT0gbmV3UGFzc3dvcmRWYWx1ZSkge1xuICAgICAgICAgICAgcmVQYXNzd29yZEZvcm0ucmVtb3ZlQ2xhc3MoJ25vLW1hdGNoJykuYWRkQ2xhc3MoJ21hdGNoJyk7XG4gICAgICAgICAgICByZVBhc3N3b3JkRm9ybS5maW5kKCdidXR0b25bdHlwZT1cInN1Ym1pdFwiXScpLnJlbW92ZUNsYXNzKCdkaXNhYmxlZCcpO1xuICAgICAgICB9XG4gICAgfSlcbn1cblxuIl0sInNvdXJjZVJvb3QiOiIifQ==