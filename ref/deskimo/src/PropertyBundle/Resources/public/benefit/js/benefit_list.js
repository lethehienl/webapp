exports.BenefitList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                var updateUrl = envUrlPrefix + '/admin/property/benefit/' + row[1] + '/update';

                var editLink = `
                  <div class="dropdown">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[1]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[1]}">
                    <a class="dropdown-item" href="${updateUrl}">Edit</a>
                    <a class="dropdown-item delete-element" data-id="${row[1]}">Delete</a>
                  </div>
                </div>`;

                return editLink;
            }
        };
        var columns = [{bVisible: false}, null, null, null, actions];
        var callbackFunc = this.delete();
        var info = {
            table_id: 'bundle-table',
            ajax_url: envUrlPrefix + '/admin/property/benefit/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'select'],
            columns: columns,
            after_draw_callback: callbackFunc,
            add_index: true
        };
        DataTableUtil.init(info);
    },

    delete: function () {
        return function () {
            var deleteElement = $('.delete-element');

            deleteElement.bind('click', function () {
                var self = $(this);
                var id = self.data('id');

                SwalCommon.deleteConfirm('Are you sure to delete this amenity?', function () {
                    var requestUrl = envUrlPrefix + '/admin/property/benefit/' + id + '/delete';
                    AjaxUtil.post(requestUrl, null, function (data) {
                        if (data.code == 200) {
                            SwalCommon.success('Deleted content successfully!')
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
