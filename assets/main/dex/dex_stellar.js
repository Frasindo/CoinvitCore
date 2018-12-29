$(document).ready(function() {
  table_main = $("#dex_stellar").DataTable({
    ajax:base_url("dex/api/stellarasset")
  });
});
