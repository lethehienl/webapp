exports.EmployeeList = {
    initComponents: function () {
        var dataForSearch = function (d) {
            var searchData = {
                keyword: $('#keyword').val(),
                status: $('#status').val(),
                group: $('#company-group').val()
            };
            return $.extend({}, d, searchData);
        };

        var actions = {
            mRender: function (data, type, row) {
                let editUrl = row[6];
                let html = `
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="${editUrl}" class="dropdown-item ga_update_info">Cập nhật hồ sơ</a>
                            <a href="${row[8]}" class="dropdown-item ga_result">Xem kết quả học </a>
                        </div>
                    </div>
                `;

                return html;
            }
        };

        let lastActive = {
            mRender: function (data, type, row) {
                let lastActive = row[5];
                let html = '';
                html += `
                    ${lastActive}
                `;

                return html;
            }
        };

        var checkBox = {
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        };

        var columns = [null, null, null, null, null, lastActive, actions, checkBox];

        var info = {
            table_id: 'employee-table',
            ajax_url: envUrlPrefix + '/company/employees/search',
            search_data: dataForSearch,
            form_search_id: 'form-search',
            search_element: ['text', 'select'],
            columns: columns
        };

        DataTableUtil.init(info);
    },

    employeeAction: function () {
        var renderOrderCourseList = function (data) {
            let html = '';

            $.each(data, function (i, val) {
                let courseName = val['course_name'];
                let orderCode = val['order_code'];
                let dayQty = val['day_qty'];
                let studentQty = val['student_qty'];
                let OrderCourseId = val['order_course_id'];

                html += `
                    <div class="form-group col-md-12 course-item-${OrderCourseId}">
                         <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="${OrderCourseId}" id="order-course-${OrderCourseId}">
                             <div class="course-info">
                                 <label class="form-check-label" for="order-course-${OrderCourseId}">
                                     ${courseName}
                                 </label>
                                 <p class="course-info-description"><span>${orderCode}</span> &bull; ${studentQty} học viên đang học &bull;
                                     <span>Còn ${dayQty} ngày </span></p>
                             </div>
                         </div>
                         <hr>
                     </div>
                    `;
            });

            return html;
        };

        let htmlEmptyOrderCourse = function () {
            return `
                <div class="form-group col-md-12">
                    <div class="course-info">
                    Học viên không có khóa học nào phù hợp.
                    </div>
                </div>
            `;
        };

        let updateForm = function (orderCourseIds) {
            $.each(orderCourseIds, function (i, val) {
                let formOption = $('.course-item-' + val);
                formOption.remove();
            });

            let orderCourseList = $('.order-course-list');
            if (orderCourseList.children().length === 0 || orderCourseIds.length === 0) {
                let popupSubmit = $('#add-student');
                popupSubmit.attr('disabled', true);
                orderCourseList.html(htmlEmptyOrderCourse);
            }
        };

        $(document).on('submit', '#add-student-popup', function (e) {
            e.preventDefault();
            let checkboxVals = [];
            let submitButton = $('#add-student');
            let employeeId = submitButton.attr("data-employee-id");

            $('#add-student-popup input[type="checkbox"]:checked').each(function () {

                checkboxVals.push($(this).val());
            });

            if (checkboxVals.length === 0) {
                Toastr.warning('Vui lòng chọn khóa học.');
                EmployeeProgressBar.elementState(0, submitButton);
                return;
            }

            let url = envUrlPrefix + '/company/course/invitation/popup/invite';
            let params = JSON.stringify({
                employeeId: employeeId,
                orderCourseIds: checkboxVals
            });
            AjaxUtil.post(url, params, function (response) {

                if (response.status.code != 200) {
                    Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                    return;
                }

                //success
                let orderCourseIds = response.data.order_course_ids;
                updateForm(orderCourseIds);
                Toastr.success(response.status.message);

            }, function (error) {
                Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                SwalCommon.stopLoading();
            }, function () {
                //before
                $("#add-student-popup input").prop("disabled", true);
                EmployeeProgressBar.elementState(1, submitButton);
                SwalCommon.showLoading();
            }, function () {
                //complete
                let dataTable = $('#data-table');
                if (dataTable.length === 1) {
                    dataTable.DataTable().ajax.reload();
                }
                $("#add-student-popup input").prop("disabled", false);
                EmployeeProgressBar.elementState(0, submitButton);
                SwalCommon.stopLoading()
            });
        });


        $(document).on('click', '.add-course', function (e) {
            e.preventDefault();
            let self = $(this);
            let employeeId = self.attr("data-employee-id");
            let url = '/company/contracts/course/employee/' + employeeId + '/management/popup';
            let popupSubmit = $('#add-student');
            let popupContent = $('.order-course-list');
            let parentNode = self.closest('.btn-group');
            popupSubmit.attr('data-employee-id', employeeId);

            AjaxUtil.get(envUrlPrefix + url, function (response) {


                if (response.status.code != 200) {
                    popupContent.html(`<span class="data-null">Không có dữ liệu</span>`);
                    Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                    return;
                }

                let orderCourseList = response.data.order_course;

                if (typeof orderCourseList == "undefined" || orderCourseList.length === 0) {
                    popupContent.html(`<span class="data-null">Không có dữ liệu</span>`);
                    return;
                }

                if (orderCourseList.length === 0) {
                    popupContent.html(updateForm(orderCourseList));
                    return;
                }

                let html = renderOrderCourseList(orderCourseList);
                popupContent.html(html);
                popupSubmit.removeAttr('hidden');

            }, function (error) {
                popupContent.html(`<span class="data-null">Không có dữ liệu</span>`);
                Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                SwalCommon.stopLoading();
            }, function () {
                // Before
                popupContent.html('');
                popupSubmit.attr('hidden', true);
                EmployeeProgressBar.addLoadingContent(popupContent);
                SwalCommon.showLoading();
            }, function () {
                // Complete
                EmployeeProgressBar.removeLoadingContent(popupContent);
                SwalCommon.stopLoading();
            });
        });

        $(document).on('submit', '#importEmployeeForm', function (e) {
            e.preventDefault();
            let form = $(this)[0];
            let popupSubmit = $('#import-employee');
            const formData = new FormData(form);
            let url = envUrlPrefix + '/company/employer/employee/import_ajax';

            AjaxUtil.postFile(url, formData, function (response) {

                if (response.status.code != 200) {
                    Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                    return;
                }

                //success
                let error = response.data.error;
                let success = response.data.success;
                let successMess = `Đã thêm thành công ${success} học viên.`;
                if (error.length > 1) {
                    successMess += ` File import dòng ${error} không đúng.`
                }

                Toastr.success(successMess);
                EmployeeProgressBar.elementState(0, popupSubmit);
            }, function (error) {
                Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                SwalCommon.stopLoading();
            }, function () {
                //before
                EmployeeProgressBar.elementState(1, popupSubmit);
                SwalCommon.showLoading();
            }, function () {
                //complete
                let dataTable = $('#employee-table');
                if (dataTable.length === 1) {
                    dataTable.DataTable().ajax.reload();
                }
                EmployeeProgressBar.elementState(0, popupSubmit);
                SwalCommon.stopLoading();
            });
        });

        $(document).on('submit', '#company-course-form', function (e) {
            e.preventDefault();

            let rowsSelected = ourTable.column(7).checkboxes.selected();

            let rowIds = [];
            $.each(rowsSelected, function (index, rowId) {
                rowIds.push(rowId);
            });

            if (rowIds.length === 0) {
                return SwalCommon.errorNotReload('Bạn vui lòng chọn ít nhất một học viên để thực hiện thao tác này');
            }

            let title = 'Bạn có chắc sẽ mời học viên được chọn vào khoá học?';
            let url = '/company/course/employee-manage/multi-invite';

            const self = $(this);
            let data = FormUtil.serializeObject(self);

            let contractCourse = data['companyCourseList'];

            if (typeof contractCourse === "undefined") {
                return SwalCommon.errorNotReload('Bạn vui lòng chọn khóa học');
            }

            let params = JSON.stringify({
                rowIds: rowIds,
                contractCourse: contractCourse,
                token: data['token']
            });

            SwalCommon.deleteConfirm(title, () => {
                SwalCommon.showLoading();
                AjaxUtil.post(envUrlPrefix + url, params, function (response) {
                    if (response.status.code != 200) {
                        Toastr.error(response.status.message);
                        return;
                    }
                    let data = response.data;
                    if (typeof (data) !== 'undefined') {
                        if (data.length > 0) {
                            let users = data.join(', ');
                            let mess = `Mời thành công: ${users}`;
                            Toastr.success(mess);
                            return;
                        }
                    }

                    Toastr.warning('Không có học viên nào được mời');
                }, function (error) {
                    SwalCommon.stopLoading();
                    Toastr.error('Thao tác không thành công');
                }, function () {
                    //before
                    SwalCommon.stopLoading();
                }, function () {
                    //complete
                    SwalCommon.stopLoading();
                    let dataTable = $('#employee-table');
                    if (dataTable.length === 1) {
                        dataTable.DataTable().ajax.reload();
                    }
                });
            })
        });

        $(document).on('submit', '#company-group-form', function (e) {
            e.preventDefault();

            let rowsSelected = ourTable.column(7).checkboxes.selected();

            let rowIds = [];
            $.each(rowsSelected, function (index, rowId) {
                rowIds.push(rowId);
            });

            if (rowIds.length === 0) {
                return SwalCommon.errorNotReload('Bạn vui lòng chọn ít nhất một học viên để thực hiện thao tác này');
            }

            let title = 'Bạn có chắc sẽ mời học viên được chọn vào nhóm?';
            let url = '/company/employee/add-group-ajax';

            const self = $(this);
            let data = FormUtil.serializeObject(self);

            let companyGroup = data['company-groups'];

            if (typeof companyGroup === "undefined") {
                return SwalCommon.errorNotReload('Bạn vui lòng chọn nhóm');
            }

            let params = JSON.stringify({
                rowIds: rowIds,
                companyGroup: companyGroup,
                token: data['token']
            });

            SwalCommon.deleteConfirm(title, () => {
                SwalCommon.showLoading();
                AjaxUtil.post(envUrlPrefix + url, params, function (response) {
                    if (response.status.code != 200) {
                        Toastr.error(response.status.message);
                        return;
                    }
                    let data = response.data;
                    if (typeof (data) !== 'undefined') {
                        if (data.length > 0) {
                            let users = data.join(', ');
                            let mess = `Mời thành công: ${users}`;
                            Toastr.success(mess);
                            return;
                        }
                    }

                    Toastr.success('Không có học viên nào được mời');
                }, function (error) {
                    SwalCommon.stopLoading();
                    Toastr.error('Thao tác không thành công');
                }, function () {
                    //before
                    SwalCommon.stopLoading();
                }, function () {
                    //complete
                    SwalCommon.stopLoading();
                    let dataTable = $('#employee-table');
                    if (dataTable.length === 1) {
                        dataTable.DataTable().ajax.reload();
                    }
                });
            })
        });

        $(document).on('submit', '#create-learner-form', function (e) {
            e.preventDefault();
            let popupSubmit = $('#create-learner-group');
            const self = $(this);
            let data = FormUtil.serializeObject(self);

            let params = JSON.stringify({
                fullName: data.learner_fullname,
                phoneNumber: data.employee_phoneNumber,
                email: data.employee_learner,
                group: data.group
            });

            let url = envUrlPrefix + '/company/employee/create-update-group-ajax';

            AjaxUtil.postFile(url, params, function (response) {

                if (response.status.code != 200) {
                    Toastr.error(response.status.message);
                    return;
                }

                //success
                let data = response.data;
                if (typeof (data) !== 'undefined') {
                    let group = data.groups;
                    if (group.length > 0) {
                        let learner = response.data.learner;
                        let successMess = `Đã thêm thành công học viên ${learner} vào group: ${group}`;
                        Toastr.success(successMess);
                        $('#create-learner-popup').modal('hide')
                    } else {
                        Toastr.success('Học viên đã trong nhóm');
                    }
                }

                EmployeeProgressBar.elementState(0, popupSubmit);
            }, function (error) {
                Toastr.error("Có lỗi xảy ra. Vui lòng liên hệ để được hỗ trợ");
                SwalCommon.stopLoading();
            }, function () {
                //before
                EmployeeProgressBar.elementState(1, popupSubmit);
                SwalCommon.showLoading();
            }, function () {
                //complete
                let dataTable = $('#employee-table');
                if (dataTable.length === 1) {
                    dataTable.DataTable().ajax.reload();
                }
                EmployeeProgressBar.elementState(0, popupSubmit);
                SwalCommon.stopLoading();
            });
        });
    },

    handleClickCheckbox: function () {

        $(document).on('change', '.dt-checkboxes, .dt-checkboxes-select-all', function () {
            let rowsSelected = ourTable.column(7).checkboxes.selected();
            $('#checked').html(rowsSelected.length);
        });
    },

    initPopupCompanyCourse: function () {
        let options = {
            placeholder: "--Vui lòng chọn--",
            allowClear: true,
            theme: "bootstrap",
            dropdownParent: "#company-course"
        };
        $("#companyCourseList").select2(options);
    },

    initPopupCompanyGroup: function () {
        let options = {
            placeholder: "--Vui lòng chọn--",
            allowClear: true,
            theme: "bootstrap",
            dropdownParent: "#add-group-popup"
        };
        $("#company-groups").select2(options);
    },

    initPopupAddLearnerGroupOption: function () {
        let options = {
            placeholder: "--Vui lòng chọn--",
            allowClear: false,
            theme: "bootstrap",
            dropdownParent: "#create-learner-popup",
            multiple: true
        };
        $("#company-group-popup").select2(options);
    },

    initPopupAddLearnerOption: function () {
        let select2 = $("#employee_learner");
        let url = envUrlPrefix + '/company/group/add-learner/select2-search';
        let options = {
            ajax: {
                url: url,
                dataType: 'json',
                data: function (params) {
                    let query = {
                        q: params.term
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            },
            placeholder: "--Vui lòng chọn / nhập mới--",
            allowClear: false,
            theme: "bootstrap",
            dropdownParent: "#create-learner-popup",
            minimumInputLength: 2,
            tags: true,
        };
        select2.select2(options);
        select2.on('select2:select', function (e) {
            let data = e.params.data;
            let fullName = data.name;
            let phoneNumber = data.phone_number;

            let nameElement = $("#employee_fullName");
            let phoneElement = $("#employee_phoneNumber");

            nameElement.val(fullName);
            phoneElement.val(phoneNumber);
        });
    },

    getURLParameter: function (sParam) {
        let sPageURL = window.location.search.substring(1);
        let sURLVariables = sPageURL.split('&');
        for (let i = 0; i < sURLVariables.length; i++) {
            let sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1];
            }
        }
    },

    initGroupFilter: function () {
        let select = $("#company-group");
        let group = this.getURLParameter('group');

        let options = {
            placeholder: "--Vui lòng chọn--",
            theme: "bootstrap",
        };
        select.select2(options);

        if (group) {
            select.val(group); // Select the option with a value of '1'
            select.trigger('change');
        }
    },

    init: function () {
        this.initComponents();
        this.employeeAction();
        this.handleClickCheckbox();
        this.initPopupCompanyCourse();
        this.initPopupCompanyGroup();
        this.initPopupAddLearnerGroupOption();
        this.initPopupAddLearnerOption();
        this.initGroupFilter();
    }
};
