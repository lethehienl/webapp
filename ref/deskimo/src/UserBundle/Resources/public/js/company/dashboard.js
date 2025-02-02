import '../../sass/dashboard.scss';
import '../../../../../AppBundle/Resources/public/js/global/chart_util.js'

const dashboard = {
    handleChart() {
        let info = {
            chart_id: 'canvas-current-user',
            ajax_url: envUrlPrefix + `/company/on-board-student/chart`,
            chart_type: 'line',
            form_search_id: 'chart-search',
            search_element: ['select'],
            title_text: 'Quá trình học tập của học viên',
        };

        ChartUtil.init(info);

        let options = {
            minimumResultsForSearch: Infinity,
            theme: "bootstrap",
        };
        $("#status").select2(options);
    },

    initDailyStudent: function () {
        let employeeInfo = {
            mRender: function (data, type, row) {
                let avt = data;
                let studentInfo = `
                            <div class="student__info">
                                <img class="student__info--avatar" src="${avt}" alt="Student Avatar" height="42px" width="42px">
                            </div>`;

                return studentInfo;
            }
        };

        let columns = [null, employeeInfo, null, null];

        let info = {
            table_id: 'student-learn-in-day',
            ajax_url: envUrlPrefix + `/company/daily-student/search`,
            columns: columns,
            paging: false,
            display_length: 10,
            empty_message: 'Chưa có học viên học',
            after_draw_callback: () => {
                $('#student-learn-in-day thead').remove();
                $('#student-learn-in-day_wrapper .top').remove();
            },
        };

        DataTableUtil.init(info);
    },

    initBestProgressStudent: function () {
        let employeeInfo = {
            mRender: function (data, type, row) {
                let avt = data;
                let studentInfo = `
                            <div class="student__info">
                                <img class="student__info--avatar" src="${avt}" alt="Student Avatar" height="42px" width="42px">
                            </div>`;

                return studentInfo;
            }
        };

        var employeeProgress = {
            mRender: function (data, type, row) {
                let progress = parseFloat(data);
                let html = `<span class="employee-status-${row[4]}"></span>`;

                if (progress === 0) {
                    html = `<span class="employee-status-${row[4]}">Đang chờ</span>`;
                } else {
                    html = `<div class="employee-status-${row[4]}">`;
                    html += EmployeeProgressBar.progressBar(progress);
                    html += `</div>`;
                }

                return html;
            }
        };

        let columns = [null, employeeInfo, null, employeeProgress, {bVisible: false}];

        let info = {
            table_id: 'best-progress-student',
            ajax_url: envUrlPrefix + `/company/student-best-progress/search`,
            columns: columns,
            paging: false,
            display_length: 10,
            empty_message: 'Chưa có học viên học',
            after_draw_callback: () => {
                $('#best-progress-student thead').remove();
                $('#best-progress-student_wrapper .top').remove();
            },
        };

        DataTableUtil.init(info);
    },

    initOnlineStudent: function () {
        let employeeInfo = {
            mRender: function (data, type, row) {
                let studentInfo = `
                            <div class="student__info">
                                <img class="student__info--avatar" src="${data}" alt="Student Avatar" height="42px" width="42px">
                            </div>`;

                return studentInfo;
            }
        };

        let nameAndCourse = {
            mRender: function (data, type, row) {
                return `<p>${data}</p>
                        <p>${row[5]}</p>`;
            }
        }

        var employeeProgress = {
            mRender: function (data, type, row) {
                let progress = parseFloat(data);
                let html = `<span class="employee-status-${row[4]}"></span>`;

                if (progress === 0) {
                    html = `<span class="employee-status-${row[4]}">Đang chờ</span>`;
                } else {
                    html = `<div class="employee-status-${row[4]}">`;
                    html += EmployeeProgressBar.progressBar(progress);
                    html += `</div>`;
                }

                return html;
            }
        };

        let columns = [null, employeeInfo, nameAndCourse, employeeProgress, {bVisible: false}, {bVisible: false}];

        let info = {
            table_id: 'online-student',
            ajax_url: envUrlPrefix + `/company/online-student/search`,
            columns: columns,
            paging: false,
            display_length: 10,
            after_draw_callback: () => {
                $('#online-student thead').remove();
                $('#online-student_wrapper .top').remove();
            },
            reload_on: 30000,
            empty_message: 'Không có học viên đang online',
        };

        DataTableUtil.init(info);
    },

    init() {
        this.handleChart();
        this.initBestProgressStudent();
        this.initDailyStudent();
        this.initOnlineStudent();
    }
};

$(document).ready(function () {
    dashboard.init();

})
