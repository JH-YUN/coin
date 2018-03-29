<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }
  public function register($param)
  {
    $this->db->set('email',$param['email']);
    $this->db->set('password',$param['password']);
    $this->db->set('name',$param['name']);
    $this->db->set('created','NOW()',false);
    $this->db->insert('user');
    return $this->db->insert_id();
  }
  public function confirm($email)
  {
    return $this->db->get_where('user',array('email'=>$email));
  }
  public function mytopic($page,$list)
  {
    $this->db->limit($list,($page-1)*$list);
    $this->db->order_by('created','DESC');
    return $this->db->get_where('topic',array('user_id'=>$this->session->userdata('id')))->result();
  }
  public function mytopic_count()
  {
    $this->db->where('user_id',$this->session->userdata('id'));
    return $this->db->get('topic')->num_rows();
  }
  public function myreply_count()
  {
    $this->db->where('user_id',$this->session->userdata('id'));
    return $this->db->get('reply')->num_rows();
  }
  public function mypage()
  {
    $this->db->where('id',$this->session->userdata('id'));
    return $this->db->get('user')->row();
  }
  public function update_profile($string)
  {
    $this->db->where('id',$this->session->userdata('id'));
    $this->db->update('user',array('info'=>$string));
  }
  public function get_userprofile($id)
  {
    $this->db->select('id,created,name,info');
    return $this->db->get_where('user',array('id'=>$id))->row();
  }
  public function topic_count($id)
  {
    $this->db->where('user_id',$id);
    return $this->db->get('topic')->num_rows();
  }
  public function reply_count($id)
  {
    $this->db->where('user_id',$id);
    return $this->db->get('reply')->num_rows();
  }
  public function getIDfromName($name)
  {
    $this->db->select('id');
    return $this->db->get_where('user',array('name'=>$name))->row()->id;
  }
  public function getNamefromID($id)
  {
    $this->db->select('name');
    return $this->db->get_where('user',array('id'=>$id))->row()->name;
  }
}
?>
