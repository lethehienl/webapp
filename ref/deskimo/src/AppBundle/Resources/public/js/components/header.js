const header = {
  togglePropertyStatus() {
    if ($('.property-status').length >= 1) {
      $('.property-status .btn-close').toggleClass('active');
      $('.property-status .btn-open').toggleClass('active');
    }
  },

  submitPropertyStatus(currentStatus) {
    const url = envUrlPrefix + '/handlePropertyStatus';
    const params = {
      status: currentStatus
    }

    AjaxUtil.post(url, params, function (response) {
      if (!response) {
        return;
      }

      SwalCommon.success('Success.. Everything is good!');

      header.togglePropertyStatus();

    }, function (error) {
      SwalCommon.errorNotReload('Warning: Something has gone wrong!');
    }, function () {
    }, function () {
    });
  },

  getCurrentStatus() {
    const currentActiveButton = $('.property-status').find('.active');
    let currentStatus = false;

    if (currentActiveButton.hasClass('btn-open')) {
      currentStatus = true;
    }

    return currentStatus;
  },

  handlePropertyStatus() {
    $(document).off('click', '.property-status .btn');
    $(document).on('click', '.property-status .btn', function (e) {
      e.preventDefault();
      let currentStatus = header.getCurrentStatus();

      if ($(this).hasClass('btn-open') && currentStatus) {
        return;
      }

      if ($(this).hasClass('btn-close') && !currentStatus) {
        return;
      }

      let message = '';
      if (currentStatus) {
        message = 'Do you want to close this property?';
      } else {
        message = 'Do you want to open this property?';
      }

      const url = $(this).attr('href');
      SwalCommon.deleteConfirm(message, function () {
        window.location.href = url;
      });
    });
  },

  init() {
    header.handlePropertyStatus();
  }
}

$(document).ready(function () {
  header.init();
});