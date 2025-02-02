const propertyUsage = {
  initActiveUsage: function() {
    var columns = [null, null, null, null, null, null, null,null];
    const propertyId = $('#property-id').val();

    var info = {
      table_id: 'active-usage-table',
      ajax_url: envUrlPrefix + '/admin/property/' + propertyId + '/statistic/transaction/active-usage',
      columns: columns,
      add_index: true,
      display_length: 100,
    };

    DataTableUtil.init(info);
  },

  initHistoryUsage: function() {
    var columns = [null, null, null, null, null, null, null,null];
    const propertyId = $('#property-id').val();

    var info = {
      table_id: 'history-usage-table',
      ajax_url: envUrlPrefix + '/admin/property/' + propertyId + '/statistic/transaction/history-usage',
      columns: columns,
      add_index: true,
      display_length: 100,
    };

    DataTableUtil.init(info);
  },

  autoGetdata: function() {
    setInterval(function() {
      var activeUsageTable = $('#active-usage-table').DataTable();
      activeUsageTable.draw();

      var historyUsageTable = $('#history-usage-table').DataTable();
      historyUsageTable.draw();
    }, 5000);
  },

  init() {
    this.initActiveUsage();
    this.initHistoryUsage();
    this.autoGetdata();
  }
}

$(document).ready(function () {
  propertyUsage.init();
});