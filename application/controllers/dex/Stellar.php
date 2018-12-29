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
