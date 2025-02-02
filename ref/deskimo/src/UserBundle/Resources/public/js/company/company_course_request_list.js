const ListCourseRequest = {
    initComponents: function () {
        let dataForSearch = function (d) {
            var searchData = {
                keyword: $('#keyword').val(),
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            };
            return $.extend({}, d, searchData);
        };

        let actions = {
            mRender: function (data, type, row) {
                let detailLink = `
                  <div class="dropdown mx-1">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[0]}">
                    <a class="dropdown-item view-detail-request" data-group_id="${data}" data-course_name="${row[2]}" data-course_id="${row[6]}" href="#">Xem chi tiết</a>
                  </div>
                </div>`;

                let actionLinks = [detailLink];

                return DataTableUtil.initActions(actionLinks);
            }
        };

        let columns = [null, null, null, null, null, actions, {bVisible: false}];

        let info = {
            table_id: 'company-course-request-table',
            ajax_url: envUrlPrefix + `/company/course-request/search`,
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'date-ranger'],
            columns: columns,
            after_draw_callback: this.handleViewRequestDetail,
        };

        DataTableUtil.init(info);
    },

    initCalendar: function () {
        let date = new Date();
        let toDate = date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear();

        $('.input-daterange').datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            language: "vi",
            startDate: toDate,
            orientation: "bottom auto",
            autoclose: true,
            showOnFocus: true,
            maxViewMode: 'days',
            keepEmptyValues: true,
        });

        $('.from_date').val();
    },

    handleViewRequestDetail: function () {
        $('.view-detail-request').on('click', function (e) {
            let self = $(this);
            let groupId = self.data('group_id');
            let courseName = self.data('course_name');
            let courseId = self.data('course_id');

            let table = `<strong>${courseName}</strong>
                        <div class="table-responsive">
                            <table id="group-course-request-table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ngày yêu cầu</th>
                                        <th scope="col" style="min-width: 70px;">Học viên yêu cầu</th>
                                        <th scope="col">Nội dung yêu cầu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>`;

            $('.modal').modal('hide');
            swal.fire({
                title: `Chi tiết yêu cầu cho khoá`,
                width: 1000,
                // type: 'info',
                html: table,
                showConfirmButton: false,
                showCloseButton: true,
                focusConfirm: false,
                customClass: 'request-history-popup'
            });

            ListCourseRequest.initSubTable(groupId, courseId);
        });
    },

    initSubTable: function (groupId, courseId) {
        let dataForSearch = function (d) {
            var searchData = {
                course_id: courseId,
                group_id: groupId,
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            };
            return $.extend({}, d, searchData);
        };

        let columns = [null, null, null, null];

        let info = {
            table_id: 'group-course-request-table',
            ajax_url: envUrlPrefix + `/company/course-request-group/search`,
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'date-ranger'],
            columns: columns,
        };

        DataTableUtil.init(info);
    },

    init: function () {
        this.initComponents();
        this.initCalendar();
    }
};

export default ListCourseRequest;
