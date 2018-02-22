<?php
class Updaterate_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  function update($result)
  {
    $this->db->set('krw',$result['1'],false);
    $this->db->set('usdt',$result['0'],false);
    $data=array('id'=>1);
    $this->db->replace('rate',$data);
    echo $this->db->last_query();
  }
  function get()
  {
    return $this->db->get_where('rate',array('id'=>1))->row();
  }
}
?>
