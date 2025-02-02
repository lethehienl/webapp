exports.InvoiceList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                var updateUrl = envUrlPrefix + '/admin/invocie/' + row[0] + '/update';
                var deleteUrl = envUrlPrefix + '/admin/invoice/' + row[0] + '/delete';
                var detailUrl = envUrlPrefix + '/admin/invoice/' + row[0] + '/delete';

                var editLink = `
                  <div class="dropdown">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[0]}">
                    <a class="dropdown-item" href="${updateUrl}">Edit</a>
                    <a class="dropdown-item detail"  href="${detailUrl}">Detail</a>
                  </div>
                </div>`;

                return editLink;
            }
        };
        var columns = [{bVisible: false}, null, null, null, null, null, null, actions];
        var callbackFunc = this.delete();
        var info = {
            table_id: 'bundle-table',
            ajax_url: envUrlPrefix + '/admin/invoice/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'select'],
            columns: columns,
            after_draw_callback: callbackFunc,
            add_index: true,
        };
        DataTableUtil.init(info);
    },

    delete: function () {
        return function () {
            var deleteElement = $('.delete-element');

            deleteElement.bind('click', function () {
                var self = $(this);
                var id = self.data('id');

                SwalCommon.deleteConfirm('Are you sure to delete this property company?', function () {
                    var requestUrl = envUrlPrefix + '/admin/property/company/' + id + '/delete';
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

    invite: function() {
        $(document).off('click', '.invite');
        const that = this;
        $(document).on('click', '.invite', function(e) {
            e.preventDefault();
            const companyId = $(this).data('company-id');
            const $inviteModal = $('#inviteModal');
            $inviteModal.modal('show');
            that.handleSubmitInviteAjax(companyId);
        })
    },

    handleSubmitInviteAjax: function(companyId) {
        $(document).off('click', '.invite-submit');
        $(document).on('click', '.invite-submit', function(e) {
            e.preventDefault();
            const $inviteModal = $('#inviteModal');
            $inviteModal.find('#property_company_account_company').val(companyId);
            const inviteUrl = envUrlPrefix + `/admin/property/company/invite`;
            const formData = $inviteModal.find('form').serialize();

            AjaxUtil.post(inviteUrl, formData, function(response) {
                if (response.status.code != 200) {
                    Toastr.error(response.status.message);
                    return;
                }

                Toastr.success(response.status.message);
                $inviteModal.modal('hide');
            }, function(response) {
                Toastr.error('Error when inviting user!');
                $inviteModal.modal('hide');
            }, null, function() {
                $inviteModal.modal('hide');
            },'application/x-www-form-urlencoded')
        })
    },

    init: function () {
        this.initComponents();
        this.invite();
    }
};
