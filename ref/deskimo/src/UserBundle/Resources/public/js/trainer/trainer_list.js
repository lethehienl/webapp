exports.TrainerList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val(), status: $('#status').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                let editUrl = row[5];
                var detailLink = `<a href="${editUrl}" class="btn btn-sm btn-pill btn-info mx-1">Edit</a>`;

                let updateStatusUrl = envUrlPrefix + '/admin/trainer/update-status';
                let status = row[4];//status
                let entityId = row[6];
                return DataTableUtil.initActions(detailLink, status, updateStatusUrl, entityId);
            }
        };

        var columns = [null, null, null, null, actions];

        var info = {
            table_id: 'trainer-table',
            ajax_url: envUrlPrefix + '/admin/trainers/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'select'],
            columns: columns,
            after_draw_callback: DataTableUtil.switchStatus()
        };

        DataTableUtil.init(info);
    },

    init: function () {
        this.initComponents();
    }
};
