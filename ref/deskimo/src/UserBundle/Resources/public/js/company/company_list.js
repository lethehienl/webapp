exports.CompanyList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                var editUrl = row[8];
                var contractUrl = row[9];
                var groupsUrl = row[10];
                var entityId = row[7];
                var status = row[6];

                // var detailLink = `<a href="${editUrl}" class="ml-2 btn btn-sm btn-pill btn-info">Edit</a>`;
                var detailLink = `
                  <div class="dropdown mx-1">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[0]}">
                    <a class="dropdown-item" href="${editUrl}">Edit</a>
                    <a class="dropdown-item" href="${contractUrl}">View contracts</a>
                    <a class="dropdown-item" href="${groupsUrl}">View employers</a>
                  </div>
                </div>`;

                var actionLinks = [detailLink];
                var activeLink = envUrlPrefix + '/admin/company/update-status';

                return DataTableUtil.initActions(actionLinks, status, activeLink, entityId);
            }
        };

        let companyCode = {
            mRender: function (data, type, row) {
                let code = row[3];

                let html = `<span style="word-break: break-all;">
                               ${code}
                            </span>`;

                return html;
            }
        };

        var columns = [null, null, null, companyCode, null, null, actions];

        var info = {
            table_id: 'company-table',
            ajax_url: envUrlPrefix + '/admin/companies/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text'],
            columns: columns,
            after_draw_callback: DataTableUtil.switchStatus()
        };

        DataTableUtil.init(info);
    },

    init: function () {
        this.initComponents();
    }
};
