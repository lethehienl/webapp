global.lineChart = null;
global.ChartUtil = {
    execute: function (info) {
        // ----- require config ------
        var chartId = info['chart_id'];
        var ajaxUrl = info['ajax_url'];
        var chartType = info['chart_type'];

        // ----- title config ------
        var titleDisplay = typeof (info['title_display']) === 'undefined' ? true : info['title_display'];
        var titlePosition = typeof (info['title_position']) === 'undefined' ? 'top' : info['title_position'];
        var titleFontFamily = typeof (info['title_font_family']) === 'undefined' ? 'Helvetica Neue' : info['title_font_family'];
        var titleFontSize = typeof (info['title_font_size']) !== "number" ? 24 : info['title_font_size'];
        var titleFontColor = typeof (info['title_font_color']) === 'undefined' ? '#4a4a4a' : info['title_font_color'];
        var titleFontStyle = typeof (info['title_font_style']) === 'undefined' ? 'bold' : info['title_font_style'];
        var titlePadding = typeof (info['title_padding']) !== 'number' ? 10 : info['title_padding'];
        var titleLineHeight = typeof (info['title_line_height']) === 'undefined' ? '1.2' : info['title_line_height'];
        var titleText = typeof (info['title_text']) === 'undefined' ? 'Default chart title' : info['title_text'];

        // ----- Element config ------
        // Point
        var elementPointRadius = typeof (info['element_point_radius']) === 'undefined' ? 3 : info['element_point_radius'];
        var elementPointStyle = typeof (info['element_point_style']) === 'undefined' ? 'circle' : info['element_point_style'];
        var elementPointRotation = typeof (info['element_point_rotation']) === 'undefined' ? 0 : info['element_point_rotation'];
        var elementPointBackgroundColor = typeof (info['element_point_background_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_point_background_color'];
        var elementPointBorderWidth = typeof (info['element_point_border_width']) === 'undefined' ? 3 : info['element_point_border_width'];
        var elementPointBorderColor = typeof (info['element_point_border_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_point_border_color'];
        var elementPointHitRadius = typeof (info['element_point_hit_radius']) === 'undefined' ? 3 : info['element_point_hit_radius'];
        var elementPointHoverRadius = typeof (info['element_point_hover_radius']) === 'undefined' ? 8 : info['element_point_hover_radius'];
        var elementPointHoverBorderWidth = typeof (info['element_point_hover_border_width']) === 'undefined' ? 4 : info['element_point_hover_border_width'];
        // Line
        var elementLineTension = typeof (info['element_line']) === 'undefined' ? 0.4 : info['element_point_hover_border_width'];
        var elementLineBackgroundColor = typeof (info['element_line_background_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_line_background_color'];
        var elementLineBorderWidth = typeof (info['element_line_border_width']) === 'undefined' ? 3 : info['element_line_border_width'];
        var elementLineBorderColor = typeof (info['element_line_border_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_line_border_color'];
        // Rectangle
        var elementRectangleBackgroundColor = typeof (info['element_rectangle_background_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_rectangle_background_color'];
        var elementRectangleBorderWidth = typeof (info['element_rectangle_border_width']) === 'undefined' ? 3 : info['element_rectangle_border_width'];
        var elementRectangleBorderColor = typeof (info['element_rectangle_border_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_rectangle_border_color'];
        var elementRectangleBorderSkipped = typeof (info['element_rectangle_border_skipped']) === 'undefined' ? 'bottom' : info['element_rectangle_border_skipped'];
        // Arc
        var elementArcBackgroundColor = typeof (info['element_arc_background_color']) === 'undefined' ? 'rgba(0, 0, 0, 0.1)' : info['element_arc_background_color'];
        var elementArcBorderWidth = typeof (info['element_arc_border_width']) === 'undefined' ? 2 : info['element_arc_border_width'];
        var elementArcBorderColor = typeof (info['element_arc_border_color']) === 'undefined' ? '#fff' : info['element_arc_border_color'];
        var elementArcBorderAlign = typeof (info['element_arc_border_align']) === 'undefined' ? 'center' : info['element_arc_border_align'];

        // ----- Filter config ------
        var formSearchId = info['form_search_id'];
        var searchElements = info['search_element'];

        var initChart = {
            type: chartType,
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        bottom: 20,
                    }
                },
                elements: {
                    line: {
                        tension: elementLineTension,
                        backgroundColor: elementLineBackgroundColor,
                        borderWidth: elementLineBorderWidth,
                        borderColor: elementLineBorderColor,
                    },
                    point: {
                        radius: elementPointRadius,
                        pointStyle: elementPointStyle,
                        rotation: elementPointRotation,
                        backgroundColor: elementPointBackgroundColor,
                        borderWidth: elementPointBorderWidth,
                        borderColor: elementPointBorderColor,
                        hitRadius: elementPointHitRadius,
                        hoverRadius: elementPointHoverRadius,
                        hoverBorderWidth: elementPointHoverBorderWidth,
                    },
                    rectangle: {
                        backgroundColor: elementRectangleBackgroundColor,
                        borderWidth: elementRectangleBorderWidth,
                        borderColor: elementRectangleBorderColor,
                        borderSkipped: elementRectangleBorderSkipped,
                    },
                    arc: {
                        backgroundColor: elementArcBackgroundColor,
                        borderAlign: elementArcBorderAlign,
                        borderColor: elementArcBorderColor,
                        borderWidth: elementArcBorderWidth,
                    }
                },
                title: {
                    display: titleDisplay,
                    position: titlePosition,
                    fontSize: titleFontSize,
                    fontFamily: titleFontFamily,
                    fontColor: titleFontColor,
                    fontStyle: titleFontStyle,
                    padding: titlePadding,
                    lineHeight: titleLineHeight,
                    text: titleText,
                },
                legend: {
                    display: false,
                    position: 'bottom',
                    label: {
                        display: false,
                        fontColor: titleFontColor,
                        fontFamily: titleFontFamily,
                        fontSize: titleFontSize
                    }
                },
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            }
                        }
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: false
                            }
                        }
                    ]
                }
            }
        };

        this.getChartData(chartId, ajaxUrl, initChart);

        let drawFunc = function (e) {
            e.preventDefault();
            lineChart.destroy();

            ChartUtil.getChartData(chartId, ajaxUrl + `?status=${$('#status').val()}`, initChart);
        };

        if (typeof (searchElements) !== 'undefined') {
            searchElements.forEach(function (item) {
                if (item == 'select') {
                    $('#' + formSearchId + ' ' + item).change(drawFunc);
                } else {
                    $('#' + formSearchId + ' input:' + item).change(drawFunc);
                }
            });
        }
    },

    getChartData: function (chartId, ajaxUrl, initChart) {
        AjaxUtil.get(ajaxUrl, function (response) {
            let currentUserChart = document.getElementById(chartId).getContext('2d');
            initChart.data = response;

            global.lineChart = new Chart(currentUserChart, initChart);
        }, function (error) {
            //error
        }, function () {
            //before
        }, function () {
            //complete
        });
    },

    init: function (info) {
        this.execute(info);
    }
};
