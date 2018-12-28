<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/**
 	 * API Restfull
 	 * @author Indra Gunanda
	 */

class Api extends REST_Controller
{
    /**
 	 * Konstruktor
 	 * @return json
	 */
    public $dpost = null;
    public $dget = null;
    public $QNT = 100000000;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("crud/main");
        $this->load->model("proses/ardor_model","ardor");
        $this->dget = $this->input->get(null,true);
        $this->dpost = $this->input->post(null,true);
        foreach ($this->dpost as $key => $value) {
          if ($value == "") {
            unset($this->dpost[$key]);
          }
        }
        foreach ($this->dget as $key => $value) {
          if ($value == "") {
            unset($this->dget[$key]);
          }
        }
    }
    /**
 	 * Initial Method
 	 *
 	 * @return json
	 */

    public function index_post()
    {
        $this->response([], 404);
    }
    /**
   * Initial Method
   *
   * @return json
   */
    public function index_get()
    {
        $this->response([], 404);
    }
    /**
   * Initial Method
   *
   * @return json
   */
    public function index_put()
    {
        $this->response([], 404);
    }
    /**
   * Initial Method
   *
   * @return json
   */
    public function index_delete()
    {
        $this->response([], 404);
    }
    public function checksk_post()
    {
      if (isset($this->dpost["dex_blockchain"])) {
        if ($this->dpost["dex_blockchain"] == "ardor") {
          $step1 = $this->ardor->get("getAccountId",["secretPhrase"=>$this->dpost["dex_secret"]]);
          if ($step1 != FALSE) {
            if (isset($step1->accountRS)) {
                $acc = $step1->accountRS;
                $step2 = $this->ardor->get("getAccount",["account"=>$acc]);
                if ($step2 != FALSE) {
                  if (!isset($step2->errorCode)) {
                      $this->response(["status"=>1,"msg"=>"Your Account Validated"]);
                  }else {
                      $this->response(["status"=>0,"msg"=>"Your Secret Key not Registered"]);
                  }
                }else {
                  $this->response(["status"=>0,"msg"=>"Account Not Found or Our Node is Down"]);
                }
            }else {
                $this->response(["status"=>0,"msg"=>"Your Secrey Key not Registered"]);
            }
          }else {
            $this->response(["status"=>0,"msg"=>"Account Not Found or Our Node is Down"]);
          }
        }elseif ($this->dpost["dex_blockchain"] == "stellar") {

        }elseif ($this->dpost["dex_blockchain"] == "eth") {

        }else {
          $this->response(["status"=>0,"msg"=>"DEX Not Found in Our System"]);
        }
      }else {
        $this->response(["status"=>0,"msg"=>"DEX Blockchain not Found"]);
      }
    }
    public function ardorasset_get()
    {
      $get = $this->ardor->get("getAllAssets",[]);
      if ($get != FALSE) {
        $res = $get->assets;
        $i = 1;
        foreach ($res as $key => &$value) {
          $value->no = $i++;
          $value->name = ucfirst($value->name);
          // $this->response($value->asset);
          $lt = $this->ardor->get("getTrades",["chain"=>2,"asset"=>$value->asset]);
          $value->last_trade = "-";
          $value->price = "-";
          $value->vol = "-";
          $value->chg = "-";
          $value->action = "<a href='".base_url("dex/ardor?asset=".$value->asset)."' class='btn btn-success'><li class='fa fa-exchange'></li></a>";
          if ($lt != FALSE) {
            // $this->response($lt);
            if (count($lt->trades) > 0) {
              $value->last_trade = $this->main->convertTimestamp($lt->trades[0]->timestamp);
              $value->price = $lt->trades[0]->priceNQTPerShare/$this->QNT;
              $onestep = 0;
              if (isset($lt->trades[1]->priceNQTPerShare)) {
                $onestep = $lt->trades[1]->priceNQTPerShare/$this->QNT;
              }
              $s = ($onestep-$value->price);
              if ($s < 0) {
                $up = ($value->price - $onestep);
                $percent = (($up*$onestep)/100);
                $value->chg = "<span class='label label-success'><li class='fa fa-caret-up'></li> ".number_format($value->price,8)."</span>";
              }else {
                $up = ($onestep - $value->price);
                $percent = (($up*$onestep)/100);
                $value->chg = "<span class='label label-danger'><li class='fa fa-caret-down'></li> ".number_format($value->price,8)."</span>";
              }
              $value->vol = 0;
              foreach ($lt->trades as $key_t => $value_t) {
                $value->vol = ($value->vol + $value_t->quantityQNT);
              }
              if ($value->vol > 0) {
                $value->vol = ($value->vol/$this->QNT);
              }
            }

          }
          if($lt)
          if ($value->asset == "4777913785555377445") {
            $value->no = 1;
            $temp = $res[0];
            $temp->no = $i;
            $res[0] = $value;
            $res[$key] = $temp;
          }
        }
        $data = $this->main->datatablesConvert($res,"no,name,price,vol,chg,last_trade,action");
        $this->response($data);
      }else {
        $this->response(["data"=>[]]);
      }
    }
    public function ardorchart_get($id='')
    {
      $lt = $this->ardor->get("getTrades",["chain"=>2,"asset"=>$id]);
      if ($lt != FALSE) {
        $data = [];
        $temp = $lt->trades;
        usort($temp, function($a, $b) {
            return $a->timestamp <=> $b->timestamp;
        });
        $time = [];
        foreach ($temp as $key => $value) {
          $time[] = $value->timestamp;
        }
        $tempdata = [];
        foreach ($temp as $key => $value) {
          foreach ($time as $x) {
            if ($x == $value->timestamp) {
              $tempdata[$x."-".$value->tradeType][] =  ($value->quantityQNT/$this->QNT);
            }
          }
        }
        foreach ($tempdata as $k => $v) {
          $s = explode("-",$k);
          $timestamp = strtotime($this->main->convertTimestamp($s[0]));
          $open = max($v);
          $high = max($v);
          $low = min($v);
          if ($s[1] == "buy") {
            $data[] = [($timestamp*1000),$open,$high,$low,$high];
          }else {
            $data[] = [($timestamp*1000),$open,$high,$low,$low];
          }
        }
        // $data = [$tempdata];
        $this->response($data);
      }else {
        $this->response([]);
      }
    }
    public function ardorbid_get($id='')
    {
      $bid = $this->ardor->get("getBidOrders",["chain"=>2,"asset"=>$id]);
      if ($bid != FALSE) {
        $temp = $bid->bidOrders;
        $n = 1;
        $sum = [];
        foreach ($temp as $key => &$value) {
          $value->size = number_format($value->quantityQNT/$this->QNT,8);
          $value->price = number_format($value->priceNQTPerShare/$this->QNT,8);
          $value->total = number_format((($value->quantityQNT/$this->QNT)+($value->priceNQTPerShare/$this->QNT)),8);
          $value->no = $n++;
        }
        $data = $this->main->datatablesConvert($temp,"price,size,total");
        $this->response($data);
      }else {
        $this->response(["data"=>[]]);
      }
    }
    public function ardorask_get($id='')
    {
      $ask = $this->ardor->get("getAskOrders",["chain"=>2,"asset"=>$id]);
      if ($ask != FALSE) {
        $temp = $ask->askOrders;
        $n = 1;
        $sum = [];
        foreach ($temp as $key => &$value) {
          $value->size = number_format($value->quantityQNT/$this->QNT,8);
          $value->price = number_format($value->priceNQTPerShare/$this->QNT,8);
          $value->total = number_format((($value->quantityQNT/$this->QNT)+($value->priceNQTPerShare/$this->QNT)),8);
          $value->no = $n++;
        }
        $data = $this->main->datatablesConvert($temp,"price,size,total");
        $this->response($data);
      }else {
        $this->response(["data"=>[]]);
      }
    }
    public function ardortradehistory_get($id='')
    {
      $lt = $this->ardor->get("getTrades",["chain"=>2,"asset"=>$id]);
      if ($lt != FALSE) {
        $data = [];
        $data["data"] = [];
        $temp = $lt->trades;
        foreach ($temp as $key => &$value) {
          $value->date = $this->main->convertTimestamp($value->timestamp);
          if ($value->tradeType == "buy") {
            $value->type = "<span class='text-green'>Buy <li class='fa fa-arrow-up'></li></span>";
          }else {
            $value->type = "<span class='text-danger'>Sell <li class='fa fa-arrow-down'></li></span>";
          }
          $value->quantity = number_format($value->quantityQNT/$this->QNT,8);
          $value->price = number_format($value->priceNQTPerShare/$this->QNT,8);
          $value->total = number_format((($value->quantityQNT/$this->QNT)+($value->priceNQTPerShare/$this->QNT)),8);
        }
        $data = $this->main->datatablesConvert($temp,"date,type,quantity,price");
        $this->response($data);
      }else {
        $this->response(["data"=>[]]);
      }
    }
}
