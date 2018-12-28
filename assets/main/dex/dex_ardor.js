$(document).ready(function() {
  console.log("Dex");
  table_main = $("#dex_ardor").DataTable({
    ajax:base_url("dex/api/ardorasset")
  })
  
});
