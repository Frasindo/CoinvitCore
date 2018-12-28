<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Indra Gunanda
 */
class Home extends CI_Controller{
  /**
 	 * Konstruktor
 	 *
 	 * @return void
	 */

  public function __construct()
  {
    parent::__construct();
    $this->load->model("crud/main");
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
    $build = [
      "block_title"=>"Dashboard DEX"
    ];
    $this->template->setjs([
      base_url("assets/main/dex/home.js")
    ],true);
    // Render
    $this->template->renderHTML(['head','home','foot'],['title'=>"Decentralize Exchange",'other'=>$build]);
  }

}
