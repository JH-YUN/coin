<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Update_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function update_coin($coin_name,$coin_krw,$coin_usdt)
  {
    $this->db->set('krw',$coin_krw,false);
    $this->db->set('usdt',$coin_usdt,false);
    $data=array('name'=>$coin_name);
    $this->db->replace('coin',$data);
  }
  function update_rate($result)
  {
    $this->db->set('krw',$result['1'],false);
    $this->db->set('usdt',$result['0'],false);
    $data=array('id'=>1);
    $this->db->replace('rate',$data);
  }
  function get_coin()
  {
    return $this->db->get('coin')->result_array();
  }
  function get_rate()
  {
    return $this->db->get_where('rate',array('id'=>1))->row_array();
  }

}
?>
