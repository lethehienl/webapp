exports.EmployerList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val(), status: $('#status').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                let editUrl = row[0];
                var detailLink = `<a href="${editUrl}" class="btn btn-sm btn-pill btn-info">Edit</a>`;
                return detailLink;
            }
        };

        var columns = [{bVisible: false}, null, null, null, null, null, actions];

        var info = {
            table_id: 'employer-table',
            ajax_url: envUrlPrefix + '/admin/employers/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'select'],
            columns: columns
        };

        DataTableUtil.init(info);
    },

    init: function () {
        this.initComponents();
    }
};
