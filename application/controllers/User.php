<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

  public function mypage()
  {
    if(!$this->session->userdata('is_login')){
      $this->session->set_flashdata('msg','로그인이 필요한 서비스입니다.');
      redirect('/auth/login');
    }
    $this->load->helper('time_cut');
    $this->load->model('user_model');
    $user=$this->user_model->mypage();
    $myreply=$this->user_model->myreply_count();
    $mytopic=$this->user_model->mytopic_count();
    $this->_head();
    $this->load->view('mypage',array('user'=>$user,'mytopic'=>$mytopic,'myreply'=>$myreply));
    $this->_footer();
  }
  public function mytopic($page)
  {
    if(!$this->session->userdata('is_login')){
      $this->session->set_flashdata('msg','로그인이 필요한 서비스입니다.');
      redirect('/auth/login');
    }
    $this->load->model('User_model');
    $this->load->library('pagination');
    $list=20;
    $mytopic=$this->User_model->mytopic($page,$list);
    $total_topic=$this->User_model->mytopic_count();//모든 게시물의 개수
    $config['total_rows']=$total_topic;
    $config['per_page']=$list;
    $config['last_url']=site_url("user/mytopic/$total_topic");
    $config['base_url']=site_url("user/mytopic");
    $config['first_url']=site_url("user/mytopic/1");
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    $pagination=$this->pagination->create_links();

    $this->_head();
    $this->load->view('mytopic',array('topic'=>$mytopic,'pagination'=>$pagination));
    $this->_footer();
  }
}
?>
