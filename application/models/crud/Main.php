<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 	 * Main CRUD
 	 *
	 */

class Main extends CI_Model{
  public $table = "";
  public $limit = [];
  public $join = [];
  public $select = '*';
  public function __construct()
  {
    parent::__construct();

  }
  /**
 	 * Set Your Table
 	 *
 	 * @param string $value
 	 * @return void
	 */

  public function setTable($value='')
  {
    $this->table = $value;
    return $this;
  }
  public function setJoin($data = [])
  {
    $this->table = $data["table"];
    $this->join = $data["join"];
  }
  public function setLimit($start='',$offset='')
  {
    $this->limit["start"] = $start;
    $this->limit["offset"] = $offset;

  }
  public function setSelect($data='*')
  {
      $this->select = $data;
  }
  /**
 	 * Run Primary Query
 	 * @example $this->main->setTable("TABLE"); $this->main->get();
 	 * @param mixed $value
 	 * @return mixed
	 */
  public function get($data = "",$order="")
  {
    if (count($this->join) > 0) {
      $this->db->select($this->select);
      $this->db->from($this->table);
      foreach ($this->join as $key => $value) {
        $exp = explode("|",$value);
        $tipe = null;
        if ($exp[2] != "null") {
          $tipe = $exp[2];
        }
        if (count($exp) > 0) {
          $this->db->join($exp[0],$exp[1],$tipe);
        }
      }
      if ($data != "") {
        $this->db->where($data);
      }
      if ($order != "") {
        $this->db->order_by($order["table"],$order["order"]);
      }
      if (count($this->limit) > 0) {
        $this->db->limit($this->limit["start"],$this->limit["offset"]);
      }
      return $this->db->get();
    }else {
      $this->db->select($this->select);
      if($data != ""){
        if($order != ""){
          if (count($this->limit) > 0) {
            return $this->db->order_by($order["table"],$order["order"])->limit($this->limit["start"],$this->limit["offset"])->get_where($this->table,$data);
          }
          return $this->db->order_by($order["table"],$order["order"])->get_where($this->table,$data);
        }else{
          if (count($this->limit) > 0) {
            return $this->db->limit($this->limit["start"],$this->limit["offset"])->get_where($this->table,$data);
          }
          return $this->db->get_where($this->table,$data);
        }
      }else{
        if($order != ""){
          if (count($this->limit) > 0) {
            return $this->db->order_by($order["table"],$order["order"])->limit($this->limit["start"],$this->limit["offset"])->get($this->table);
          }
          return $this->db->order_by($order["table"],$order["order"])->get($this->table);
        }else{
          if (count($this->limit) > 0) {
            return $this->db->limit($this->limit["start"],$this->limit["offset"])->get($this->table);
          }
          return $this->db->get($this->table);
        }
      }
    }
  }
  /**
 	 * Run Primary Query
 	 * @example $this->main->setTable("TABLE"); $this->main->get();
 	 * @param mixed $value
 	 * @return mixed
	 */
  public function insert($data=[])
  {
    return $this->db->insert($this->table,$data);
  }
  /**
 	 * Run Primary Query
 	 * @example $this->main->setTable("TABLE"); $this->main->get();
 	 * @param mixed $value
 	 * @return mixed
	 */
  public function delete($data=[])
  {
     $this->db->delete($this->table,$data);
     return $this->db->affected_rows() > 0;
  }
  /**
 	 * Run Primary Query
 	 * @example $this->main->setTable("TABLE"); $this->main->get();
 	 * @param mixed $value
 	 * @return mixed
	 */
  public function update($data=[],$where=[])
  {
    if(count($where) > 0){
      $this->db->update($this->table,$data,$where);
      return $this->db->affected_rows() > 0;
    }else{
      $this->db->update($this->table,$data);
      return $this->db->affected_rows() > 0;
    }
  }
  public function datatablesConvert($res=[],$select="")
  {
    $data = [];
    $data["data"] = [];
    foreach ($res as $key => $value) {
      $inner = [];
      $exp = explode(",",$select);
      foreach ($exp as $k => $v) {
        $inner[] = $value->{"$v"};
      }
      $data["data"][] = $inner;
    }
    return $data;
  }
  public function select2Convert($data=[],$op=[])
  {
    $s = [];
    $s[] = ["text"=>"== Pilih ==","id"=>""];
    foreach ($data as $key => $value) {
      $s[] = ["text"=>$value->{$op["text"]},"id"=>$value->{$op["id"]}];
    }
    return $s;
  }
  public function convertTimestamp($epoch=0)
  {
    $begin = strtotime("2018-01-01 00:00:00 +0000");
    return date("Y-m-d H:m:s",($epoch  + $begin - 500));
  }

}
