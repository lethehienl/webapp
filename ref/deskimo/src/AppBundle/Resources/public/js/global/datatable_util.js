global.ourTable = null;
global.ourTable2 = [];
global.DataTableUtil = {
    execute: function (info) {
        var tableId = info['table_id']; // 'my-table'
        var ajaxUrl = info['ajax_url']; // '/rider/search'
        var searchData = info['search_data']; //{keyword: 'test', active:1,....}
        var formSearchId = info['form_search_id']; //'rider-form-search'
        var searchElements = info['search_element']; //['text', 'select', 'radio', ....]
        var columns = info['columns'];
        var paging = typeof (info['paging']) === 'undefined' ? true : info['paging'];
        var functionCallbackAfterDraw = info['after_draw_callback'];
        var displayLength = typeof (info['display_length']) === 'undefined' ? 10 : info['display_length'];
        var reloadOn = typeof (info['reload_on']) === 'undefined' ? false : info['reload_on'];
        var emptyMessage = typeof (info['empty_message']) === 'undefined' ? false : info['empty_message'];
        var addIndex = typeof (info['add_index']) === 'undefined' ? false : info['add_index'];

        var initTables = {
            responsive: true,
            sPaginationType: "full_numbers",
            dom: '<"top"i>rt<"bottom mt-4"flp><"clear">',
            processing: true,
            serverSide: true,
            bLengthChange: false,
            iDisplayLength: displayLength,
            bFilter: false,
            select: {style: 'multi'},
            ordering: false,
            bPaginate: paging,
            columns: this.decorateColumn(columns),
            autoWidth: false,
            ajax: {url: ajaxUrl, data: searchData},
            language: {
                processing: "<i class='fa fa-spinner fa-pulse fa-fw'></i>",
                search: "",
                paginate: {
                    "first": "«",
                    "last": "»",
                    "next": ">",
                    "previous": "<"
                },
                info: "Hiển thị từ _START_ đến _END_ trên _TOTAL_ kết quả"
            },
        };

        if (emptyMessage) {
            initTables.language.emptyTable = emptyMessage;
        }

        if (addIndex) {
            initTables.fnRowCallback = function (row, data, index) {
                var info = ourTable.page.info();

                if (info) {
                    $('td', row).eq(0).html(index + 1 + info.page * info.length);
                }

            };
        }

        if (functionCallbackAfterDraw != undefined && typeof functionCallbackAfterDraw === "function") {
            initTables.drawCallback = functionCallbackAfterDraw;
        }

        ourTable = $('#' + tableId).DataTable(initTables);
        ourTable2[tableId] = ourTable;

        var searchFunc = function (e) {
            e.preventDefault();
            ourTable.draw();
            ourTable2[tableId].draw();
        };

        if (typeof (searchElements) !== 'undefined') {
            searchElements.forEach(function (item) {
                if (item == 'text') {
                    $('#' + formSearchId + ' input:' + item).keyup(searchFunc);
                    $('#' + formSearchId + ' input:' + item).change(searchFunc);
                } else if (item == 'select') {
                    $('#' + formSearchId + ' ' + item).change(searchFunc);
                } else if (item == 'date-ranger') {
                    $('#' + formSearchId + ' #from_date').change(searchFunc);
                    $('#' + formSearchId + ' #to_date').change(searchFunc);
                } else {
                    $('#' + formSearchId + ' input:' + item).change(searchFunc);
                }
            });
        }

        if (typeof (reloadOn) === "number") {
            setInterval(function () {
                ourTable.draw();
                ourTable2[tableId].draw();
            }, reloadOn);
        }
    },

    decorateColumn: function (columns) {
        if (columns == undefined) {
            return null;
        }

        var newColumns = [];
        var index = 0;
        var length = columns.length;

        if (length <= 0) {
            return null;
        }

        for (; index < length; index++) {
            var item = columns[index];

            if (item == null) {
                newColumns[index] = {data: index, render: $.fn.dataTable.render.text()};
            } else {
                newColumns[index] = item;
            }
        }

        return newColumns;
    },

    switchStatus: function (switcherClass = 'change-status-switcher') {
        return function (settings) {
            $('.' + switcherClass).bind('change', function () {
                var currentElement = $(this);
                var id = currentElement.data('id');
                var requestUrl = currentElement.data('url');
                var params = JSON.stringify({id: id, status: currentElement.is(':checked') ? 1 : 0});

                AjaxUtil.post(requestUrl, params, function (data) {
                    console.log(data);
                })
            });
        }
    },

    initActions: function (actionLinks, statusActive, updateActiveLink, entityId, switchClass = 'change-status-switcher') {
        var actions = '<div class="d-flex align-items-center">';
        var links = '';
        var activeCheckbox = '';

        if (actionLinks != null) {
            var index = 0;
            var length = actionLinks.length;

            for (; index < length; index++) {
                links += actionLinks[index];
            }
        }

        if (statusActive != null) {
            var checked = statusActive == 1 ? 'checked' : '';

            activeCheckbox = '<label class="c-switch c-switch-label c-switch-pill c-switch-info mb-0">' +
                '<input class="c-switch-input ' + switchClass + '" data-id="' + entityId + '"   data-url="' + updateActiveLink + '" type="checkbox" ' + checked + '>' +
                '<span class="c-switch-slider" data-checked="On" data-unchecked="Off">' +
                '</span></label>';
        }

        actions += activeCheckbox + links + '</div>';
        return actions;
    },

    init: function (info) {
        this.execute(info);
    }
};
