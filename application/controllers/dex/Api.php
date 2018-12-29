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
        $this->load->library('curl_lib');
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
        $this->main->setTable("ardortoken");
        $res = $this->main->get();
        $res = $res->result();
        $data = $this->main->datatablesConvert($res,"no,name,price,vol,chg,last_trade,action");
        $this->response($data);
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
    public function ardorcron_get()
    {
      $get = $this->ardor->get("getAllAssets",[]);
      if ($get != FALSE) {
        $res = $get->assets;
        $i = 1;
        $ins = [];
        foreach ($res as $key => &$value) {
          $value->no = $i++;
          $value->name = ucfirst($value->name);
          // $this->response($value->asset);
          $lt = $this->ardor->get("getTrades",["chain"=>2,"asset"=>$value->asset]);
          $value->last_trade = "-";
          $value->price = "-";
          $value->vol = "-";
          $value->chg = "-";
          $value->action = "<a href='".base_url("exchange/dex/ardor?asset=".$value->asset)."' class='btn btn-success'><li class='fa fa-exchange'></li></a>";
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
        $no = 1;
        foreach ($res as $key => $value) {
          echo $value->name." Telah Ditemukan Dengan Volume ".$value->vol.PHP_EOL;
          if ($value->vol > 0) {
            $ins[] = ["no"=>$no++,"name"=>$value->name,'price'=>$value->price,"vol"=>$value->vol,"chg"=>$value->chg,"last_trade"=>$value->last_trade,"action"=>$value->action];
          }else {
            echo "Volume ".$value->name." Tidak Memenuhi Syarat".PHP_EOL;
          }
        }
        // $data = $this->main->datatablesConvert($res,"no,name,price,vol,chg,last_trade,action");
        // $this->response($data);
        $s = $this->db->truncate('ardortoken');
        if ($s) {
          echo "Data Terdahulu Berhasil di Bersihkan".PHP_EOL;
        }else {
          echo "Data Terdahulu Gagal di Bersihkan".PHP_EOL;
        }
        $a = $this->db->insert_batch("ardortoken",$ins);
        if ($a) {
          echo "Data Telah Tersimpan".PHP_EOL;
        }else {
          echo "Data Gagal Tersimpan".PHP_EOL;
        }
      }else {
        echo "Gagal Mengambil Data".PHP_EOL;
      }
    }
    public function stellarasset_get()
    {
      $this->main->setTable("stellartoken");
      $res = $this->main->get();
      $res = $res->result();
      $data = $this->main->datatablesConvert($res,"no,name,status,score,price,vol,action");
      $this->response($data);
    }
    public function stellarcron_get()
    {
      $curl = $this->curl_lib;
      $offset = 0;
      $loopcast = true;
      $no = 2;
      $data = [];
      // $asset = $curl->get("https://stellar.api.stellarport.io/v6/Asset?search=&offset=0&limit=100&verified&depositable");
      // $asset = json_decode($asset);
      // $this->response($asset[0]->nativeTradeVolumes->daily);
      $pause = 0;
      do {
        $asset = $curl->get("https://stellar.api.stellarport.io/v6/Asset?search=&offset=".$offset."&limit=100&verified&depositable");
        if ($asset != FALSE) {
          $asset = json_decode($asset);
          $k =0;
          foreach ($asset as $key => $value) {
            if ($value->tomlUrl != null) {
              $vol = 0;
              if (isset($value->nativeTradeVolumes->daily)) {
                $vol = $value->nativeTradeVolumes->daily;
              }
              echo "Ditemukan Asset Dengan TOML ".$value->tomlUrl.PHP_EOL;
              $data[] = ["no"=>$no++,"status"=>"<span class='label label-success'><li class='fa fa-check'></li> Verified</span>","score"=>number_format($value->networkTrustScore*10,1),"name"=>$value->code,"price"=>$value->nativePrice,"vol"=>number_format($vol),"action"=>"<a href='".base_url("exchange/dex/stellar?asset=".$value->issuerId)."' class='btn btn-success'><li class='fa fa-exchange'></li></a>"];
              if ($value->code == "FRAS" && $value->issuerId == "GC75WHUIMU7LV6WURMCA5GGF2S5FWFOK7K5VLR2WGRKWKZQAJQEBM53M") {
                $temp = $data[0];
                $data[0] = $data[$k];
                $data[$k]  = $temp;
              }
            }else {
              $pause++;
              echo "Tidak Ditemukan Lagi Asset".PHP_EOL;
              break;
            }
            $k++;
          }

        }else {
          $loopcast = false;
          echo "Gagal Ambil Data Asset".PHP_EOL;
          break;
        }
        if ($pause > 1) {
          $loopcast = false;
        }
        $offset = $offset + 100;
      } while ($loopcast == true);
      $n = 1;
      foreach ($data as $key => &$value) {
        $value["no"] = $n++;
      }
      $trunc = $this->db->truncate("stellartoken");
      if ($trunc) {
        echo "Pembersihan Data Berhasil".PHP_EOL;
      }else {
        echo "Pembersihan Data Gagal".PHP_EOL;
      }
      $save = $this->db->insert_batch("stellartoken",$data);
      if ($save) {
        echo "Saved !!".PHP_EOL;
      }else {
        echo "Fail !!".PHP_EOL;
      }

    }
}
