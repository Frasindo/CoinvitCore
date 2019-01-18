$(document).ready(function() {
  console.log("Global JS Start");
  // Sample
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
  //Scroll
  $('#asset').slimScroll({
    color: '#d2d6de',
    railOpacity: 0.3,
    width: '100%',
    height: 'calc(86vh - 220px)'
  });

  $('#coin-slider').slimscroll({
    color: '#d2d6de',
    railOpacity: 0.3,
    height: '40px',
    width: '100%',
    axis: 'x'
  });
  //Handle starring for glyphicon and font awesome
  $("span").click(function(e) {
    e.preventDefault();
    //detect type
    var $this = $(this).find("i");
    var fa = $this.hasClass("fa");

    //Switch states
    if (fa) {
      $this.toggleClass("fa-star");
      $this.toggleClass("fa-star-o");
    }

  });

  $("li.cc").click(function() {
    var idx = $(this).index();
    $("li.cc").eq(idx).attr("id", "favo");
  });

  /*$("li").click(function (){
    var li = $("li a span i.fa-star");
    if (li.is("li a span i.fa-star")) {
          li.attr("id", "favo");
      }
  });*/

  $("#fav").change(function() {
    if (this.checked) {
      $("li#favo").show();
      $("li#cc").hide();
    } else {
      $("li#favo").show();
      $("li#cc").show();
    }

  });
  $('.dropdown-submenu a.submenu').on("click", function(e) {
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
  var ul = $('ul:first.sidebar-menu'),
    ulHeight = ul.outerHeight();

  ul.on('mousemove',
    function(e) {
      var win = $(window),
        cST = win.scrollTop();
      if (e.pageY >= (ulHeight / 2)) {
        win.scrollTop(cST + 20);
      } else {
        win.scrollTop(cST - 20);
      }
    });


});
