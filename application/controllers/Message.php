<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Message extends MY_Controller
{
    function __construct()
    {
      parent::__construct();
      if(!$this->session->userdata('is_login')){
        alert_location(site_url('auth/login').'?returnURL='.rawurlencode(site_url('message/receive_list/1')),'로그인 해주세요.');
      }
    }
    public function send()
    {
        $receiver=!(empty($this->input->get('receiver'))) ? $this->input->get('receiver') : null;
        $this->load->library('form_validation');
        $rules=array(
          array(
            'field'=>'title',
            'label'=>'제목',
            'rules'=>'required',
            'errors'=>array('required'=>'제목을 입력해주세요.')),
          array(
            'field'=>'desc',
            'label'=>'본문',
            'rules'=>'required',
            'errors'=>array('required'=>'본문을 입력해주세요')),
          array(
            'field'=>'receiver',
            'label'=>'받는 사람',
            'rules'=>'required|in_DB[user.name]',
            'errors'=>array('required'=>'받는 사람을 입력해주세요',
              'in_DB'=>'받는 사람이 존재하지 않는 회원입니다.'))
          );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()==false) {
            $this->_head();
            $this->load->view('message_nav');
            $this->load->view('send_message',array('receiver'=>$receiver));
            $this->_footer();
        } else {
            $this->load->model('message_model');
            $this->load->model('user_model');
            $title=$this->input->post('title');
            $desc=$this->input->post('desc');
            $receiver=$this->user_model->getIDfromName($this->input->post('receiver'));
            $sender=$this->session->userdata('id');
            if ($this->message_model->send($sender, $receiver, $title, $desc)) {
                alert_location(site_url('message/send'), '전송 완료');
            } else {
                alert_location(site_url('message/send'), 'DB 오류 전송 실패');
            }
        }
    }
    public function receive_list($page)
    {
        $this->load->model('message_model');
        $list=10;
        $message=$this->message_model->get_receive_list($page, $list);
        $total_message=count($message);//모든 게시물의 개수
        $config['total_rows']=$total_message;
        $config['per_page']=$list;
        $config['last_url']=site_url("message/receive_list/$total_message");
        $config['base_url']=site_url("message/receive_list");
        $config['first_url']=site_url("message/receive_list/1");
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $pagination=$this->pagination->create_links();
        $this->_head();
        $this->load->view('message_nav');
        $this->load->view('receive_list', array('message'=>$message,'pagination'=>$pagination));
        $this->_footer();
    }

    public function send_list($page)
    {
        $this->load->model('message_model');
        $list=10;
        $message=$this->message_model->get_send_list($page, $list);
        $total_message=count($message);//모든 게시물의 개수
        $config['total_rows']=$total_message;
        $config['per_page']=$list;
        $config['last_url']=site_url("message/send_list/$total_message");
        $config['base_url']=site_url("message/send_list");
        $config['first_url']=site_url("message/send_list/1");
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $pagination=$this->pagination->create_links();
        $this->_head();
        $this->load->view('message_nav');
        $this->load->view('send_list', array('message'=>$message,'pagination'=>$pagination));
        $this->_footer();
    }

    public function read($id)
    {
        $this->load->model('message_model');
        $this->load->model('user_model');
        $message=$this->message_model->read($id);
        //자신이 보내거나 받은 메세지가 아닌 메세지에 접근할 경우
        if(!(($this->session->userdata('id')==$message->sender) || ($this->session->userdata('id')==$message->receiver))){
            alert_location(site_url('message/receive_list/1'),'잘못된 접근입니다.');
        }
        $this->message_model->check_message($id);
        $message->sender=$this->user_model->getNamefromID($message->sender);
        $message->receiver=$this->user_model->getNamefromID($message->receiver);
        $this->_head();
        $this->load->view('message_nav');
        $this->load->view('read_message',array('message'=>$message));
        $this->_footer();
    }
    public function delete()
    {
      $this->load->model('message_model');
      $delete_list=$this->input->post('delete_list');
      switch($this->input->get('type'))
      {
        case 'receive':
          if(empty($delete_list)) {
            alert_location(site_url('message/receive_list/1'),"선택된 쪽지가 없습니다.");
            break;
          }
          $this->message_model->delete('receive',$delete_list);
          alert_location(site_url('message/receive_list/1'),"삭제 완료");
          break;
        case 'send':
          if(empty($delete_list)) {
            alert_location(site_url('message/send_list/1'),"선택된 쪽지가 없습니다.");
            break;
          }
          $this->message_model->delete('send',$delete_list);
          alert_location(site_url('message/send_list/1'),"삭제 완료");
          break;
      }
    }
    public function notice()
    {
      $this->load->model('message_model');
      echo json_encode($this->message_model->notice());
    }
    public function welcome_message($id)
    {
      $this->load->model('message_model');
      $this->message_model->welcome_message($id);
    }
}
