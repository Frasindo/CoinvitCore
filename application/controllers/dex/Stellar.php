<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Indra Gunanda
 */
class Stellar extends CI_Controller{
  /**
 	 * Konstruktor
 	 *
 	 * @return void
	 */
  public $dget;
  public $lib;
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
        $ass = $this->dget["asset"];
        $ass = explode("-",$this->dget["asset"]);
        if (count($ass) != 2) {
          redirect("exchange/dex");
        }
        $url = "https://stellar.api.stellarport.io/v6/Asset/alphanum4/".$ass[1]."/".$ass[0];
        $data =  $this->lib->get($url);
        if ($data == FALSE) {
          redirect("exchange/dex");
        }
        $data = json_decode($data->body);
        $usd_price = $this->lib->get("https://api.coingecko.com/api/v3/simple/price?ids=stellar&vs_currencies=usd");
        if ($usd_price == FALSE) {
          redirect("exchange/dex");
        }
        $usd_price = json_decode($usd_price->body);
        $vol = 0;
        if (isset($data->nativeTradeVolumes->daily)) {
          $vol = $data->nativeTradeVolumes->daily;
        }
        $last_trade = "-";
        if (isset($data->recentTradeAggs->weekly)) {
          $a = (count($data->recentTradeAggs->weekly) - 1);
          $s = $data->recentTradeAggs->weekly[$a];
          $last_trade = date("Y-m-d",strtotime($s->begin));
        }
        $this->main->setTable("stellartoken");
        $get = $this->main->get();
        $asset = [];
        foreach ($get->result() as $key => $value) {
          $asset[] =   [
              "token_name"=>$value->token_name,
              "issuer"=>substr($value->issuer,0,3)."...".substr($value->issuer,-3),
              "toml_website"=>$value->toml_website,
              "price"=>number_format($value->price,4),
              "change_value"=>number_format($value->change_value,4),
              "change_status"=>$value->change_status,
              "volume"=>number_format($value->volume,2),
              "blockchain"=>"stellar",
              "asset_id"=>$value->issuer
            ];
        }
        $add =  $this->main->get(["issuer"=>$ass[0]]);
        $cStatus = "minus";
        $color = "text-default";
        if ($add->row()->change_status == "success") {
          $color = "text-green";
          $cStatus = "caret-up";
        }elseif ($add->row()->change_status == "danger") {
          $color = "text-red";
          $cStatus = "caret-down";
        }
        if (!isset($data->toml->image)) {
          $img = "https://static.thenounproject.com/png/128599-200.png";
        }else {
          $img = $data->toml->image;
        }
        $build = [
          "block_title"=>$data->code." - XLM",
          "name"=>$data->code,
          "trade_volume"=>$vol,
          "change_color"=>$color,
          "change_icon"=>$cStatus,
          "change_value"=>number_format($add->row()->change_value,4),
          "last_price"=>number_format($data->nativePrice,4),
          "last_trade"=>$last_trade,
          "usd_price"=>number_format($usd_price->stellar->usd*$data->nativePrice,4),
          "trust_line"=>$data->numAccounts,
          "total_supply"=>number_format(($data->amount+1)),
          "img"=>$img
        ];
        $this->template->setjs([
          base_url("assets/main/dex/dex_stellar_trade.js")
        ],true);
        // Render
        $this->template->renderHTML(['head','stellar_trade','foot'],["sidebar_asset"=>$asset,'title'=>$data->code." - XLM",'other'=>$build]);
    }else {
      $build = [
        "block_title"=>"Stellar"
      ];
      $this->template->setjs([
        base_url("assets/main/dex/dex_stellar.js")
      ],true);
      $this->main->setTable("stellartoken");
      $get = $this->main->get();
      $asset = [];
      foreach ($get->result() as $key => $value) {
        $asset[] =   [
            "token_name"=>$value->token_name,
            "issuer"=>substr($value->issuer,0,3)."...".substr($value->issuer,-3),
            "toml_website"=>$value->toml_website,
            "price"=>number_format($value->price,4),
            "change_value"=>number_format($value->change_value,4),
            "change_status"=>$value->change_status,
            "volume"=>number_format($value->volume,2),
            "blockchain"=>"stellar",
            "asset_id"=>$value->issuer
          ];
      }
      // Render
      $this->template->renderHTML(['head','stellar','foot'],["sidebar_asset"=>$asset,'title'=>"Stellar",'other'=>$build]);
    }
  }

}
