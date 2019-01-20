$(document).ready(function() {
  console.log("dex_stellar_trade.js");
  $.getJSON(base_url('exchange/dex/api/stellarchart/' + getParam("asset")), function(data) {
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
        credits: {
          enabled: false
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
    $(".highcharts-credits").remove();
  });
  $.get(base_url('exchange/dex/api/stellardepth/' + getParam("asset")),function(data){
    Highcharts.chart('chart_depth', {
    chart: {
      type: 'area',
      zoomType: 'xy'
    },
    title: {
      text: (getParam("asset").split("-"))[1]+' - XLM Market Depth'
    },
    xAxis: {
      minPadding: 0,
      maxPadding: 0,
      plotLines: [{
        color: '#888',
        value: 0.1523,
        width: 1,
        label: {
          text: 'Actual price',
          rotation: 90
        }
      }],
      title: {
        text: 'Price'
      }
    },
    yAxis: [{
      lineWidth: 1,
      gridLineWidth: 1,
      title: null,
      tickWidth: 1,
      tickLength: 5,
      tickPosition: 'inside',
      labels: {
        align: 'left',
        x: 8
      }
    }, {
      opposite: true,
      linkedTo: 0,
      lineWidth: 1,
      gridLineWidth: 0,
      title: null,
      tickWidth: 1,
      tickLength: 5,
      tickPosition: 'inside',
      labels: {
        align: 'right',
        x: -8
      }
    }],
    legend: {
      enabled: false
    },
    plotOptions: {
      area: {
        fillOpacity: 0.2,
        lineWidth: 1,
        step: 'center'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size=10px;">Price: {point.key}</span><br/>',
      valueDecimals: 2
    },
    series: [{
      name: 'Bids',
      data: data.bids,
      color: '#03a7a8'
    }, {
      name: 'Asks',
      data:data.asks,
      color: '#fc5857'
    }]
  });
  });

  $(".highcharts-credits").remove();
  $('#bid').DataTable({
    'paging': true,
    'searching': false,
    'info': false,
    'lengthChange': false,
    'pagingType': 'full_numbers',
    'responsive': true,
    "dom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    'autoWidth': false
  })
  $('#ask').DataTable({
    'paging': true,
    'searching': false,
    'info': false,
    'lengthChange': false,
    'pagingType': 'full_numbers',
    'responsive': true,
    "dom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    'autoWidth': false
  })
  $('#mh').DataTable({
    'paging': true,
    'searching': false,
    'info': false,
    'ordering': true,
    'lengthChange': false,
    'pagingType': 'full_numbers',
    'responsive': true,
    "dom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    'autoWidth': false
  })
  $('#oo').DataTable({
    'paging': true,
    'searching': false,
    'info': false,
    'ordering': true,
    'lengthChange': false,
    'pagingType': 'full_numbers',
    'responsive': true,
    "dom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    'autoWidth': false
  })
  $('#yth').DataTable({
    'paging': true,
    'searching': false,
    'info': false,
    'ordering': true,
    'lengthChange': false,
    'pagingType': 'full_numbers',
    'responsive': true,
    "dom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    'autoWidth': false
  })
});
