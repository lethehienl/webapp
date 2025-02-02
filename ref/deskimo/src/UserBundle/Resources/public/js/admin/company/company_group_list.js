exports.CompanyGroupList = {
    initComponents: function () {
        let dataForSearch = function (d) {
            let searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        let actions = {
            mRender: function (data, type, row) {
                let forceLoginUrl = row[4];
                let detailLink = `
                  <div class="dropdown mx-1">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[0]}">
                    <a class="dropdown-item" href="${forceLoginUrl}">Force login</a>
                  </div>
                </div>`;

                let actionLinks = [detailLink];

                return DataTableUtil.initActions(actionLinks);
            }
        };

        var slug = $('#company_id').val();

        let columns = [null, null, null, null, actions];

        let info = {
            table_id: 'company-group-table',
            ajax_url: envUrlPrefix + `/admin/company/${slug}/groups/search`,
            search_data: dataForSearch,
            form_search_id: 'form-search-group',
            search_element: ['text'],
            columns: columns
        };

        DataTableUtil.init(info);
    },

    init: function () {
        this.initComponents();
    }
};
