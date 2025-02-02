import '../sass/admin_dashboard.scss';

const adminDashboard = {
  handleChart(chartTitle = '', unit = '', chartData, chartElement, isWidget = false) {
    if (!chartData) {
      return;
    }

    $('#' + chartElement).closest('.card').find('.chart-total').html(chartData.total);

    const ctx = $('#' + chartElement);
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: chartData.labels,
        datasets: [{
          label: chartTitle,
          data: chartData.value,
          borderColor: 'rgba(0, 0, 0, .75)',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        aspectRatio: 4,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              display: !isWidget,
              drawBorder: !isWidget,
            },
            ticks: {
              display: !isWidget,
            }
          },
          x: {
            grid: {
              display: !isWidget,
              drawBorder: !isWidget,
            },
            ticks: {
              display: !isWidget,
            }
          },
        },
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              title: function () {
                return '';
              },
            }
          }
        }
      }
    });
  },

  getData4Chart() {
    const url = envUrlPrefix + '/admin/property/statistic/overview/chart';


    AjaxUtil.get(url, function (response) {
      console.log(response);
      adminDashboard.handleChart('Total Revenue (SGD)', 'SGD', response.data.revenue_chart, 'revenue-chart', false);
      adminDashboard.handleChart('Total Users', 'User(s)', response.data.users, 'user-chart', true);
      adminDashboard.handleChart('Total Usage (Min)', 'Min', response.data.usage, 'usage-chart', true);
      adminDashboard.handleChart('Avg Usage Per Stay (Min)', 'Min', response.data.avg_usage, 'avg-usage-chart', true);

    }, function (error) {
     console.log(error);
    });
  },

  initActiveUsage: function() {
    let actions = {
      mRender: function (data, type, row) {
        let status = row[9];

        if (status == 1) {
          return '';
        }

        return `
                  <div class="dropdown">
                    <button class="btn btn-outline-primary" type="button" id="dropdownMenuButton${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row[0]}">
                      <a class="dropdown-item checkout-element" data-id="${row[0]}">Check out</a>
                    </div>
                </div>`;
      }
    };

    var columns = [{bVisible: false}, null, null, null, null, null, null, null, null, actions];
    var callbackFunc = this.checkoutVisit();

    var info = {
      table_id: 'active-usage-table',
      ajax_url: envUrlPrefix + '/admin/property/statistic/transaction/active-usage/dashboard',
      columns: columns,
      add_index: false,
      display_length: 15,
      after_draw_callback: callbackFunc,
    };

    DataTableUtil.init(info);
  },

  checkoutVisit() {
    return function () {
      let checkoutElement = $('.checkout-element');

      checkoutElement.bind('click', function () {
        var self = $(this);
        var id = self.data('id');

        SwalCommon.deleteConfirm('Are you sure to checkout?', function () {
          let requestUrl = envUrlPrefix + '/admin/visit/' + id + '/manual-checkout';

          AjaxUtil.post(requestUrl, null, function (response) {
            if (response.status.code == 200) {
              SwalCommon.success('Success.. Everything is good!');
              return;
            }

            SwalCommon.errorNotReload('Warning: Something has gone wrong!');
          });
        });
      });
    }
  },

  pullNewActiveUsage: function () {
    setInterval(function() {
      var historyUsageTable = $('#active-usage-table').DataTable();
      historyUsageTable.draw();
    }, 5000);
  },

  init() {
    adminDashboard.getData4Chart();
    this.initActiveUsage();
    this.pullNewActiveUsage();
  }
};

$(document).ready(function () {
  adminDashboard.init();
});