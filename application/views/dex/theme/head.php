<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta content="Coinvit DEX & Centralize Trading Platform" name="description" />
      <meta name="keywords" content="crypto,ardor,trading,frasindo">
      <meta name="author" content="">
      <title>{title}</title>
      {css}
      <link rel="stylesheet" href="{url}">
      {/css}

   </head>
   <body>
     <script type="text/javascript">
       function base_url(url="") {
         return "<?= base_url() ?>"+url;
       }
     </script>

 <div id="overlayLoader">
    <div id="preloader">
      <span></span>
      <span></span>
   </div>
</div>


      <section class="wrapper">
         <nav class="navbar navbar-default navbar-top navbar-fixed-top">
            <div class="navbar-header">
               <a href="#" class="navbar-brand">
                  <div class="brand-logo"><center><img src='<?= base_url("assets/images/logocoinvit.png") ?>' class="img-responsive" style="width:70px;height:auto;" alt=""></center></div>
                  <div class="brand-logo-collapsed">
                    <img src='<?= base_url("assets/images/logocoinvit.png") ?>' class="img-responsive" style="width:100px;height:auto" alt="">
                  </div>
               </a>
            </div>
            <div class="nav-wrapper">
               <ul class="nav navbar-nav mt0">
                  <li>
                     <a href="#" data-toggle="aside">
                     <em class="fa fa-align-left"></em>
                     </a>
                  </li>
               </ul>
               <ul class="nav navbar-nav navbar-right mt0" id="box_login">
                  <li class="dropdown dropdown-list">
                     <a href="#" data-toggle="dropdown" id="login" data-play="fadeIn" class="dropdown-toggle">
                     <strong>Login / Register</strong>
                     </a>
                  </li>
               </ul>
               <ul class="nav navbar-nav navbar-right mt0" id="box_logout">
                  <li class="dropdown dropdown-list">
                     <a href="#" data-toggle="dropdown" id="logout" data-play="fadeIn" class="dropdown-toggle">
                     <strong>Logout</strong>
                     </a>
                  </li>
               </ul>
            </div>
         </nav>
         <aside class="aside">
            <nav class="sidebar">
               <ul class="nav">
                  <li>
                     <div data-toggle="collapse-next" class="item user-block has-submenu">
                        <div class="user-block-picture">
                           <img src="https://example.com" onerror="this.src='//via.placeholder.com/50x50?text=?'" id="dex_logo" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle account-img-mb">
                        </div>
                        <div class="user-block-info">
                           <span class="user-block-name item-text" id="dex_address">DEX</span>
                           <span class="user-block-role" id="dex_blockchain"> Blockchain</span>
                        </div>
                     </div>

                  </li>
                  <?php
                  $base = function($url){
                    return base_url("exchange/dex/".$url);
                  };
                  ?>
                  <li class="">
                     <a href="<?=  $base("") ?>" title="Dashboard" class="">
                        <em class="fa fa-dashboard"></em>
                        <span class="item-text">Dashboard</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="#" title="Blockchain Wallet" data-toggle="collapse-next" class="has-submenu">
                        <em class="fa fa-home"></em>
                        <div class="label pull-right"><i class="fa fa-line-chart"></i></div>
                        <span class="item-text">Market</span>
                     </a>
                     <ul class="nav collapse">
                        <li>
                           <a href="<?= $base("ardor") ?>" title="Ardor Wallet" data-toggle="" class="no-submenu">
                           <span class="item-text">DEX Ardor</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?= $base("stellar") ?>" title="Stellar Wallet" data-toggle="" class="no-submenu">
                           <span class="item-text">DEX Stellar</span>
                           </a>
                        </li>
                        <li>
                           <a href="<?= $base("eth") ?>" title="ETH Wallet" data-toggle="" class="no-submenu">
                           <span class="item-text">DEX Ethereum</span>
                           </a>
                        </li>
                     </ul>
                  </li>

               </ul>
            </nav>
         </aside>
