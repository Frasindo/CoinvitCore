<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Indra Gunanda
 */
class Ardor extends CI_Controller{
  /**
 	 * Konstruktor
 	 *
 	 * @return void
	 */
  public $dget;
  public $lib;
  public $QNT = 100000000;
  public function __construct()
  {
    parent::__construct();
    $this->load->model("crud/main");
    $this->load->model("proses/ardor_model");
    $this->load->library("curl_lib");
    $this->dget = $this->input->get(null,true);
    $this->lib = $this->curl_lib;
    foreach ($this->dget as $key => &$value) {
      if ($value == "") {
        unset($this->dget[$key]);
      }
    }
  }
  /**
 	 * Index Home
 	 *
 	 * @return void
	 */

  function index()
  {
    $this->template->setFolder("dex");
    $this->template->defaultStyle("exchange");
    if (isset($this->dget["asset"])) {
      $get_name = $this->ardor_model->get("getAsset",["chain"=>2,"asset"=>$this->dget["asset"]]);
      if ($get_name != FALSE) {
        if (!isset($get_name->name)) {
          redirect("exchange/dex");
        }
        $bid = $this->ardor_model->get("getBidOrders",["chain"=>2,"asset"=>$this->dget["asset"]]);
        $ask = $this->ardor_model->get("getAskOrders",["chain"=>2,"asset"=>$this->dget["asset"]]);
        if ($bid == FALSE && $ask == FALSE) {
          redirect("exchange/dex");
        }
        $bid_price = 0;
        if (count($bid->bidOrders) > 0) {
          $bid_price = ($bid->bidOrders[0]->priceNQTPerShare/$this->QNT);
        }
        $ask_price = 0;
        if (count($ask->askOrders) > 0) {
          $ask_price = ($ask->askOrders[0]->priceNQTPerShare/$this->QNT);
        }


        // $bid = $bid->bidOrders;
        $total_trade = 0;
        $last_trade = "-";
        $volume = 0;
        $obj = $this->ardor_model->get("getTrades",["chain"=>2,"asset"=>$this->dget["asset"]]);
        if ($obj != FALSE) {
          $total_trade = count($obj->trades);
          if ($total_trade > 0) {
            $last_trade = $this->main->convertTimestamp($obj->trades[0]->timestamp);
            foreach ($obj->trades as $key => $value) {
              $see = $this->main->convertTimestamp($value->timestamp);
              if ($see == date("Y-m-d")) {
                $volume = $value->quantityQNT + $volume;
              }
            }
          }
        }
        $build = [
          "block_title"=>$get_name->name." - IGNIS",
          "total_trade"=>number_format($total_trade),
          "last_trade"=>$last_trade,
          "total_supply"=>number_format($get_name->quantityQNT/$this->QNT),
          "trade_volume"=>number_format($volume/$this->QNT),
          "name_asset"=>$get_name->name,
          "bid_price"=>$bid_price,
          "ask_price"=>$ask_price
        ];
        $this->template->setjs([
          base_url("assets/main/dex/dex_ardor_trade.js")
        ],true);
        // Render
        $this->template->renderHTML(['head','ardor_trade','foot'],['title'=>$get_name->name." - IGNIS",'other'=>$build]);
      }else {
        redirect("exchange");
      }
    }else {
      $build = [
        "block_title"=>"DEX Ardor"
      ];
      $this->template->setjs([
        base_url("assets/main/dex/dex_ardor.js")
      ],true);
      // Render
      $this->template->renderHTML(['head','ardor','foot'],['title'=>"DEX Ardor",'other'=>$build]);
    }
  }

}
