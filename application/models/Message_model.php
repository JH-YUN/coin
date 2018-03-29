<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message_model extends CI_Model{
  function __construct(){
    parent::__construct();
  }
    public function send($sender,$receiver,$title,$desc)
    {
        $this->db->set('sender',$sender);
        $this->db->set('receiver',$receiver);
        $this->db->set('title',$title);
        $this->db->set('description',$desc);
        $this->db->set('time','NOW()',false);
        $this->db->insert('user_message');
        return true;
    }
    public function get_receive_list($page,$list)
    {
          $this->db->select('user_message.id,user_message.sender,user_message.receiver,user_message.title,user_message.description,user_message.time,user_message.check,user.name');
          $this->db->from('user_message');
          $this->db->join('user', 'user_message.sender=user.id', 'left');
          // $this->db->limit($list,$page);
          $this->db->limit($list, ($page-1)*$list);
          $this->db->order_by('user_message.time', 'DESC');
          $this->db->where('receiver',$this->session->userdata('id'));
          $this->db->where('receiver_del','0');

          return $this->db->get()->result();

    }
    public function get_send_list($page,$list)
    {
          $this->db->select('user_message.id,user_message.sender,user_message.receiver,user_message.title,user_message.description,user_message.time,user_message.check,user.name');
          $this->db->from('user_message');
          $this->db->join('user', 'user_message.receiver=user.id', 'left');
          // $this->db->limit($list,$page);
          $this->db->limit($list, ($page-1)*$list);
          $this->db->order_by('user_message.time', 'DESC');
          $this->db->where('sender',$this->session->userdata('id'));
          $this->db->where('sender_del','0');
          return $this->db->get()->result();

    }
    public function read($id)
    {
        return $this->db->get_where('user_message',array('id'=>$id))->row();
    }
    public function check_message($id)
    {
        $this->db->where('id',$id);
        $this->db->update('user_message',array('check'=>'1'));
    }
    public function delete($type,$delete_list)
    {
        switch ($type)
        {
          case 'receive':
            foreach($delete_list as $list)
            {
              $this->db->or_where('id',$list);
            }
            $this->db->update('user_message',array('receiver_del'=>'1'));
            break;
          case 'send':
            foreach($delete_list as $list)
            {
              $this->db->or_where('id',$list);
            }
            $this->db->update('user_message',array('sender_del'=>'1'));
            break;
        }
    }
    public function delete_cli()
    {
      $this->db->where('sender_del','1');
      $this->db->where('receiver_del','1');
      $this->db->delete('user_message');
    }
    public function notice()
    {
      $this->db->where('check','0');
      $this->db->where('receiver',$this->session->userdata('id'));
      return $this->db->get('user_message')->num_rows();
    }
    public function welcome_message($id)
    {
      $this->db->set('receiver',$id);
      $this->db->set('title','가입을 축하합니다.');
      $this->db->set('description','암호화폐 가격비교 사이트에 가입해주셔서 감사합니다.');
      $this->db->set('time','NOW()',false);
      $this->db->set('sender_del','1');
      $this->db->insert('user_message');

    }
}
?>
