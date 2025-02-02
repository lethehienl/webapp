exports.googleAPI = {
  // generateLatLong(address = null) {
  //   console.log('generate lat long');
  //   let addressEncode = encodeURI(address);
  //   const url = 'https://maps.googleapis.com/maps/api/geocode/json';
  //
  //   let data = {
  //     address: addressEncode,
  //     region: 'vn',
  //     key: 'AIzaSyCSot_bD4HkeXy9UTyGsRWg_2KSpAX3f7I'
  //   };
  //
  //   $.ajax({
  //     url,
  //     data,
  //     success: function (response) {
  //       console.log(response);
  //     },
  //     error: function (error) {
  //       console.log(error);
  //     },
  //   })
  //
  // },
  autocompleteAddress(selector = null) {
    console.log('Auto complete address');
  },
};