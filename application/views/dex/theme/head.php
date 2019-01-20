<?php
$base = function($url = ''){
  return base_url("exchange/dex/".$url);
};
 ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{title}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {css}
  <link rel="stylesheet" href="{url}">
  {/css}
  <style type="text/css">
    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
      background-color: #F5F5F5;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      background-color: #F5F5F5;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
      background-color: #d2d6de;
    }

    .pagination>.active>a,
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span,
    .pagination>.active>span:focus,
    .pagination>.active>span:hover {
      background-color: #373435;
      border-color: #373435;
    }

    body {
      width: 1790px;
      overflow-x: scroll;
    }

    .etc {
      margin-left: -20px;
      width: 300px;
    }

    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
    }

    .submenu {
      padding-top: 5px;
    }

    .logo-socmed {
      margin-top: 20px;
      padding: 5px;
      font-size: 28px;
    }

    .main-footer {
      background: #27323a;
      color: #c3c1c1;
    }


    div.scrollmenu {
      background-color: #232e32;
    }

    div.scrollmenu a {
      font-size: 12px;
      display: inline-block;
      color: white;
      text-align: center;
      padding: 8px;
      text-decoration: none;
    }

    div.scrollmenu a:hover {
      background-color: #777;
    }

    .skin-blue .main-header .logo {
      background-color: #020203;
      color: #fff;
      padding-top: 5px;
      border-bottom: 0 solid transparent;
    }

    .view-pager {
      margin-top: -20px;
    }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue fixed sidebar-mini sidebar-collapse">
  <script type="text/javascript">
    const base_url = function(url=""){
      return "<?= base_url("") ?>"+url;
    };
  </script>
  <div class="wrapper">

    <header class="main-header">
      <nav>
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="collapse navbar-collapse" style="background-color: #000;">

          <ul class="nav navbar-nav navbar-right">

            <li><a href="balance.php">Markets</a></li>

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Decentralize <span class="caret"></span>
              </a>

              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#">Generate new wallet</a></li>
                <li><a tabindex="-1" href="#">Login with your own private key</a></li>
              </ul>

            </li>


            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Centralize <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <a class="submenu" tabindex="-1" href="#">
                    Coinvit Deposit Withdrawal <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">BUY CRYPTO with CREDIT CARD</a></li>
                  </ul>

                </li>

              </ul>
            </li>


            <li>
              <a href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Google_Translate_Icon.png" width="20" height="20">
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-moon-o"></i>
              </a>
            </li>

            <li>
              <a href="#" data-toggle="modal" data-target="#modal-lr">
                Login / Register
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-wifi text-green"></i>
              </a>
            </li>
            <!--  <li>
                   <a role="menuitem" tabindex="-1" href="#">
                     Coinvit Balance History
                   </a>
                 </li>

                 <li>
                   <a role="menuitem" tabindex="-1" href="#">
                     Open Orders + Trade History
                   </a>
                 </li>

                 <li>
                   <a role="menuitem" tabindex="-1" href="#">
                     Open Orders + Trade History
                   </a>
                 </li>

                 <li class="dropdown-submenu">
                   <a class="submenu" tabindex="-1" href="#">
                     ACCOUNTS <span class="caret"></span>
                   </a>

                   <ul class="dropdown-menu">
                     <li><a tabindex="-1" href="#">Profile</a></li>
                     <li><a tabindex="-1" href="#">Password</a></li>
                     <li><a tabindex="-1" href="#">2FA Two-Factor-Authentication</a></li>
                     <li><a tabindex="-1" href="#">API keys</a></li>
                     <li><a tabindex="-1" href="#">Whitelist</a></li>
                     <li><a tabindex="-1" href="#">Notifications</a></li>
                     <li><a tabindex="-1" href="#">Refferal Bonus</a></li>
                   </ul>

                 </li>
                  -->


          </ul>

      </nav>

      <nav class="navbar navbar-static-top" style="background-color: #232e32; z-index: -1;  min-height: 40px;">

        <div class="scrollmenu" id="coin-slider">
          <a href="<?= $base("ardor") ?>">ARDOR</a>
          <a href="<?= $base("nxt") ?>">NXT</a>
          <a href="<?= $base("stellar") ?>">XLM</a>
          <a href="<?= $base("waves") ?>">WAVES</a>
          <a href="<?= $base("eth") ?>">ETH</a>
          <a href="<?= $base("tron") ?>">TRON</a>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <!-- Content Header (Page header) -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <!-- Sidebar user panel -->

      <?php
        $class = $this->router->fetch_class();
        $icon = ["stellar"=>"https://bittrexblobstorage.blob.core.windows.net/public/c41db2ef-2635-4438-a1c1-0a680c8857e1.png","waves","ardor","nxt","eth","tron","home"=>"https://static.thenounproject.com/png/128599-200.png"];
      ?>
      <div class="user-panel">
        <div class="pull-left">
          <img src="<?= $icon[$class] ?>" style="width: 100%; max-width: 45px; height: auto;">
        </div>
        <div class="pull-left info">
          <p style="font-size: 28px; font-style: italic;">{title}</p>
        </div>
      </div>

      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>

        <div class="checkbox text-right" style="color: white; margin-right: 10px; margin-left: 15px;">
          <label>
            <input type="checkbox" id="fav">
            Show
            <i class="fa fa-star text-yellow"></i>
            Only
          </label>
        </div>
      </form>
      <!-- /.search form -->
      <section>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree" id="asset">
          {sidebar_asset}
          <li class="cc" >
            <a href="<?= $base() ?>{blockchain}?asset={asset_id}-{token_name}" style="height: 60px;">
              <i style="font-size: 18px;">{token_name}</i>
              <span style="font-size: 12px; font-color: grey;">{issuer} | {toml_website}</span>
              <span class="pull-right-container">
                <i class="fa fa-star-o text-yellow pull-right"></i>
              </span>
              <br>

              <i class="text-{change_status}">{price}</i>
              <span class="text-{change_status}" style="margin-left: 5px;"> {change_value} %</span>
              <span style="margin-left: 5px;">{volume}</span>
            </a>
          </li>
          {/sidebar_asset}

        </ul>
        <!-- /.sidebar -->
        <div class="" style="margin-right: 8px; margin-left: 8px;">
          <button type="button" class="btn btn-danger btn-block">TOKEN</button>
          <button type="button" class="btn btn-warning btn-block">FIAT</button>
        </div>
      </section>
    </aside>
<div class="tab-content">
