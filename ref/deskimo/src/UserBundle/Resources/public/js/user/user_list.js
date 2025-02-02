exports.UserList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                return '<a href="' + row[1] + '" class="mr-3 btn btn-info">Edit</a>';
            }
        };

        var columns = [null, {bVisible: false}, null, null, null, null, null, actions];

        var info = {
            table_id: 'user-table',
            ajax_url: envUrlPrefix + '/admin/users/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text'],
            columns: columns
        };

        DataTableUtil.init(info);
    },

    init: function () {
        this.initComponents();
    }
};
