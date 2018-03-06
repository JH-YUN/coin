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
  }
  public function confirm($email)
  {
    return $this->db->get_where('user',array('email'=>$email));
  }
}
?>
