$(document).ready(function() {
  console.log("dex_stellar_trade.js");
  $.getJSON(base_url('exchange/dex/api/stellarchart/'+getParam("asset")), function(data) {
    Highcharts.setOptions({
    global: {
      useUTC: false
    }
    });
    Highcharts.stockChart('chart_trade', {
      chart: {},
      rangeSelector: {
        selected: 0
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
              'day', // unit name
              [0] // allowed multiples
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
});
