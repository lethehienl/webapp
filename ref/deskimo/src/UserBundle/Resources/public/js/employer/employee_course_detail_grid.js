const EmployeeCourseDetailGrid = {
    initComponents: function () {
        let dataForSearch = function (d) {
            let searchData = {keyword: $('#keyword').val()};
            return $.extend({}, d, searchData);
        };

        let sectionProgress = {
            mRender: function (data, type, row) {
                let status = row[1];

                let html = ``;
                if (status === '') {
                    html += `<span class="text-warning">Chưa có dữ liệu </span>`;
                }

                if (status === 0) {
                    html += `<span class="text-warning">Đang xem </span>`;
                }

                if (status === 1) {
                    html += `<span class="text-success">Đã xem </span>`;
                }

                return html;
            }
        };

        let columns = [null, sectionProgress];

        let courseInviteId = $('#courseInviteId').val();

        let info = {
            table_id: 'data-table',
            ajax_url: envUrlPrefix + '/company/employee/course/details/search/' + courseInviteId,
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

export default EmployeeCourseDetailGrid;