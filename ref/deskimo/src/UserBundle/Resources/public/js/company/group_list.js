exports.GroupList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                let editUrl = row[6];
                let learnersUrl = row[7];
                let coursesUrl = row[8];

                let html = `
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="${editUrl}" class="dropdown-item">Chỉnh sửa</a>
                            <a href="${learnersUrl}" class="dropdown-item">Học viên</a>
                            <a href="${coursesUrl}" class="dropdown-item">Khóa học</a>
                        </div>
                    </div>
                `;

                return html;
            }
        };

        var columns = [null, null, null, null, null, null, actions];

        var info = {
            table_id: 'group-table',
            ajax_url: envUrlPrefix + '/company/group/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text'],
            columns: columns,
            after_draw_callback: DataTableUtil.switchStatus()
        };

        DataTableUtil.init(info);
    },
    ga() {
        app.gaAction('ga_edit_information', 'Quản lí nhóm', 'Edit_Information');
    },
    init: function () {
        this.initComponents();
        this.ga();
    }
};
