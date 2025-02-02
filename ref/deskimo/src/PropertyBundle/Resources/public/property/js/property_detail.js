import '../css/property_detail.scss';

const propertyDetail = {
  renderImagesList(imageListHtml) {
    console.log('imageListHtml: ', imageListHtml)
    $('.image-list').html(imageListHtml);
    propertyDetail.handleDeletePicture();
  },

  ajaxDeletePicture(removeUrl) {
    AjaxUtil.delete(removeUrl, {}, function(response) {
      const pictures = response.data.pictures;
      const picturesListHtml = propertyDetail.buildImageListHtml(pictures);
      propertyDetail.renderImagesList(picturesListHtml);
      Toastr.success('Remove picture successfully!');
    }, function(response) {
      Toastr.error(response.status.message);
    });
  },

  handleDeletePicture() {
    $('.remove-image').click(function(e) {
      e.preventDefault();
      const removeUrl = $(this).data('remove-url');
      propertyDetail.ajaxDeletePicture(removeUrl);
    })
  },

  buildImageItemHtml(image) {
    if (!image) {
      return '';
    }

    const propertyId = $('.property-detail').data('property-id');
    const removeUrl = envUrlPrefix + `/admin/property/${propertyId}/${image.id}/images/delete`;
    return `
            <li class="ui-state-default image-item image-area">
                <img src="${image.uri}" alt="image-${image.id}">
                <a class="remove-image" data-remove-url="${removeUrl}" href="#" style="display: inline;">&#215;</a>
            </li>
        `;
  },

  buildImageListHtml(images) {
    if (!images) {
      return '';
    }

    const imagesHtmlArr = images.map(function(image) {
      return propertyDetail.buildImageItemHtml(image);
    });

    return imagesHtmlArr.join('');
  },

  handleSlick() {
    $('.amenity__list').slick({
      infinite: false,
      slidesToShow: 5,
      variableWidth: true,
      slidesToScroll: 1,
      initialSlide: 0,
      dots: true,
    })

    $('.photo__list').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      asNavFor: '.photo__thumb-list',
    });

    $('.photo__thumb-list').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: '.photo__list',
      focusOnSelect: true,
      variableWidth: true,
      responsive: [
        {
          breakpoint: 575,
          settings: {
            variableWidth: false,
          }
        }
      ]
    });
  },

  // handleDragDrop() {
  //   $("#sortable").sortable({
  //     distance: 1,
  //     tolerance: 'pointer'
  //   });
  // },

  handleDropZone() {
    Dropzone.autoDiscover = false;
    const propertyUrl = $('.property-detail').data('upload-url');
    Dropzone.options.uploadMedia = {
      url: propertyUrl,
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 2, // MB
      addRemoveLinks: false,
      acceptedFiles: "image/jpeg, image/jpg, image/png, image/tiff",
      uploadMultiple: false,
      dictDefaultMessage: "Please select images belows 4MB",
      dictInvalidFileType: "Please select type of images: jpg, png, tiff",
      dictFileTooBig: "Please select images belows 4MB",
      dictMaxFilesExceeded: "Maximum images upload is 6",
      dictResponseError: "Somethings wrong! Please contact Admin!",
      dictFallbackText: "Somethings wrong! Please contact Admin!",
      error: function (file, message) {
        Toastr.error(message.status.message);
      },
      init: function() {
        this.on("success", function(file, response) {
          const pictures = message.data.pictures;
          const picturesListHtml = propertyDetail.buildImageListHtml(pictures);
          propertyDetail.renderImagesList(picturesListHtml);
          Toastr.success('Add picture successfully!');
        })
      }
    };

    $('#dropzone').dropzone({url: propertyUrl});
  },

  init() {
    propertyDetail.handleSlick();
    // propertyDetail.handleDragDrop();
    propertyDetail.handleDropZone();
    propertyDetail.handleDeletePicture();
  }
};

$(function() {
  setTimeout(function() {
    propertyDetail.init();
  }, 500)
});