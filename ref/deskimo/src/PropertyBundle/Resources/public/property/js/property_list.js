exports.PropertyList = {
  initComponents: function () {
    var dataForSearch = function (d) {
      var searchData = {keyword: $('#keyword').val()};
      return $.extend({}, d, searchData);
    };


    var image = {
      mRender: function (data, type, row) {
        return '<img src="' + row[3] + '" class="rounded" style="width: 80px;" />';
      }
    };

    var mainColumn = {
      //TODO KHOA DO IN THIS
      mRender: function (data, type, row) {
        console.log('Row: ', row[1]);

        const mainColumnHTML = '' +
          '<div class="main-column">' +
          ` <div class="main-column__row title">${row[1]}</div>` +
          ` <div class="main-column__row">${row[2]}</div>` +
          ` <div class="main-column__row">${row[3]}</div>` +
          '</div>';

        return mainColumnHTML;
      }
    };

    var actions = {
      mRender: function (data, type, row) {
        var updateUrl = envUrlPrefix + '/admin/property/' + row[0] + '/update';
        var deleteUrl = envUrlPrefix + '/admin/property/' + row[0] + '/delete';

        const mainColumnHTML = '' +
          '<div class="main-column">' +
          ` <a href="/admin/property/${row[0]}/detail"><div class="main-column__row title">${row[1]}</div></a>` +
          ` <div class="main-column__row">${row[2]}</div>` +
          ` <div class="main-column__row">${row[3]}</div>` +
          '</div>';

        const editLink = `
                  <div class="dropdown">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[0]}">
                    <a class="dropdown-item" href="${updateUrl}">Edit</a>
                  </div>
                </div>`;

        const columnWrapper = '<div class="main-column__wrapper">' + mainColumnHTML + editLink + '</div>';

        return columnWrapper;
      }
    };
    var columns = [actions];
    var callbackFunc = this.delete();
    var info = {
      table_id: 'bundle-table',
      ajax_url: envUrlPrefix + '/admin/property/search',
      search_data: dataForSearch,
      form_search_id: 'form-search',
      search_element: ['text', 'select'],
      columns: columns,
      after_draw_callback: callbackFunc,
      add_index: false
    };
    DataTableUtil.init(info);
  },

  delete: function () {
    return function () {
      var deleteElement = $('.delete-element');

      deleteElement.bind('click', function () {
        var self = $(this);
        var id = self.data('id');

        SwalCommon.deleteConfirm('Are you sure to disable this property?', function () {
          var requestUrl = envUrlPrefix + '/admin/property/' + id + '/delete';
          AjaxUtil.post(requestUrl, null, function (data) {
            if (data.code == 200) {
              SwalCommon.success('Disabled content successfully!')
            } else {
              SwalCommon.errorNotReload('Can not delete this content, it is used by another one');
            }
          });
        });
      });
    }
  },
  init: function () {
    this.initComponents();
  }
};
