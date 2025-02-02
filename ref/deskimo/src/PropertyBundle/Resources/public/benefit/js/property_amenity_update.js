exports.PropertyAmenityUpdate = {

  handleDisableAmenity: function() {
    var _this = this;
    $('.amenity_update_checkbox').click (function () {
      if(this.checked) {
        var amenityUpdateType = $(this).data('type');
        $('#' + amenityUpdateType).prop( "checked", false );
      }
    });
  },

  init: function () {
    this.handleDisableAmenity();
  }
};
