<?php
class Updatecoin_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function update($coin_name,$coin_krw, $coin_usdt)
  {
    $this->db->set('krw',$coin_krw,false);
    $this->db->set('usdt',$coin_usdt,false);
    $data=array('name'=>'BTC');
    $this->db->replace('coin',$data);
    echo $this->db->last_query();
  }
  function get($coin_name)
  {
    return $this->db->get_where('coin',array('name'=>$coin_name))->row();
  }

}
?>
