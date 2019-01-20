$(document).ready(function() {
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
