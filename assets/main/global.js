$(document).ready(function() {
  console.log("Global JS Start");
  check();
  function check() {
    cek = check_login();
    if (cek != undefined) {
    	$("#box_logout").show();
    	$("#box_login").hide();
    }else {
    	$("#box_logout").hide();
    	$("#box_login").show();
    }
  }
  $("#login").on('click', function(event) {
    event.preventDefault();
    var dialog = bootbox.dialog({
        title: 'Prepare Menu ',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          dialog.find(".modal-title").html("Login / Register");
          $build = [
            '<div class="row">',
            '<div class="col-md-12">',
            '<form action="" method="post" onsubmit="return false">',
            '<div class="col-md-12">',
            '<div class="form-group">',
            '<label>Secret Key</label>',
            '<input type="text" class="form-control" name="secret_key" placeholder="Your secret key">',
            '</div>',
            '</div>',
            '<div class="col-md-4">',
            '<div class="form-group">',
            '<button type="button" id="login_ardor" class="btn btn-default btn-block">Login Ardor</button>',
            '</div>',
            '</div>',
            '<div class="col-md-4">',
            '<div class="form-group">',
            '<button type="button" id="login_stellar" class="btn btn-default btn-block">Login Stellar</button>',
            '</div>',
            '</div>',
            '<div class="col-md-4">',
            '<div class="form-group">',
            '<button type="button" id="login_eth" class="btn btn-default btn-block">Login Ethereum</button>',
            '</div>',
            '</div>',
            '</div>',
            '</form>',
            '</div>',
            '</div>',
          ];
          dialog.find(".bootbox-body").html($build.join(""));
          dialog.find("login_ardor").on('click', function(event) {
            event.preventDefault();
            toastr.info("Checking . . .");
            
          });
        },2000);
      });
    });
  $("#logout").on('click', function(event) {
    event.preventDefault();

  });
});
