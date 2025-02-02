exports.ScheduleUpdate = {

  scheduleCustomHide: function(_this) {
    $(_this).parents('.weekendDay').find('.customActive').hide();
    $(_this).parents('.weekendDay').find('.customNotActive').show();
  },

  scheduleCustomShow: function(_this) {
    $(_this).parents('.weekendDay').find('.customActive').show();
    $(_this).parents('.weekendDay').find('.customNotActive').hide();
  },

  scheduleCustom: function() {
    var _this = this;
    $('.customCheckbox').click (function () {
      if(this.checked) {
        _this.scheduleCustomShow(this);
        $(this).parents('.weekendDay').find('.customCheckboxClose').prop( "checked", false );
        $(this).parents('.weekendDay').find('.customCheckbox24').prop( "checked", false );

      } else {
        _this.scheduleCustomHide(this);
      }
    });

    $('.customCheckboxClose').click (function () {
      if(this.checked) {
        $(this).parents('.weekendDay').find('.customCheckbox').prop( "checked", false );
        $(this).parents('.weekendDay').find('.customCheckbox24').prop( "checked", false );
        _this.scheduleCustomHide(this);
      }
    });

    $('.customCheckbox24').click (function () {
      if(this.checked) {
        $(this).parents('.weekendDay').find('.customCheckbox').prop( "checked", false );
        $(this).parents('.weekendDay').find('.customCheckboxClose').prop( "checked", false );
        _this.scheduleCustomHide(this);
      }
    });
  }
        ,

  init: function () {
    this.scheduleCustom();
  }
};
