$(document).ready(function() {
  console.log("DEX Trade");
  $.getJSON(base_url('exchange/dex/api/ardorchart/'+getParam("asset")), function(data) {
    Highcharts.stockChart('chart_trade', {
      chart: {},
      rangeSelector: {
        selected: 1
      },
      series: [{
        type: 'candlestick',
        name: 'Trade Chart',
        credits:{
          enabled:false
        },
        data: data,
        dataGrouping: {
          units: [
            [
              'week', // unit name
              [1] // allowed multiples
            ],
            [
              'month',
              [1, 2, 3, 4, 6]
            ]
          ]
        }
      }]
    });
  });
  bid_table = $("#bid_table").DataTable({
    ajax:base_url("exchange/dex/api/ardorbid/"+getParam("asset")),
    pagingType:"simple"
  })
  ask_table = $("#ask_table").DataTable({
    ajax:base_url("exchange/dex/api/ardorask/"+getParam("asset")),
    pagingType:"simple"
  })
  market_history = $("#market_history").DataTable({
    ajax:base_url("exchange/dex/api/ardortradehistory/"+getParam("asset"))
  });
});
