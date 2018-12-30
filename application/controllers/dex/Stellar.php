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

        $build = [
          "block_title"=>$data->code." - XLM",
          "trade_volume"=>$vol,
          "last_trade"=>$last_trade,
          "trust_line"=>$data->numAccounts,
          "total_supply"=>number_format(($data->amount+1))
        ];
        $this->template->setjs([
          base_url("assets/main/dex/dex_stellar_trade.js")
        ],true);
        // Render
        $this->template->renderHTML(['head','stellar_trade','foot'],['title'=>$data->code." - XLM",'other'=>$build]);
    }else {
      $build = [
        "block_title"=>"DEX Stellar"
      ];
      $this->template->setjs([
        base_url("assets/main/dex/dex_stellar.js")
      ],true);
      // Render
      $this->template->renderHTML(['head','stellar','foot'],['title'=>"DEX Stellar",'other'=>$build]);
    }
  }

}
