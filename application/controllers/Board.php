<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends MY_Controller {
  // public function index($page) //순수 php를 활용한 페이지네이션
  // {
  //   $this->load->model('board_model');
  //   $this->load->model('user_model');
  //   $list=20;
  //   $topic=$this->board_model->get_php($page, $list);
  //   $total_topic=$this->board_model->get_count();
  //   $this->_head();
  //   $this->load->view('board_page_php',array('topic'=>$topic,'page'=>$page,'list'=>$list,'total_topic'=>$total_topic));
  //   //$this->load->view('board',array('topic'=>$topic));
  //   $this->_footer();
  // }
  public function index($page)//ci 를 활용한 페이지네이션
  {
    $this->load->model('board_model');
    $this->load->model('user_model');
    $list=20;//페이지당 보일 게시물
    if(empty($this->input->get('search_type'))){
      $topic=$this->board_model->get($page, $list);
      $total_topic=$this->board_model->get_count();//모든 게시물의 개수
      $config['total_rows']=$total_topic;
      $config['per_page']=$list;
      $config['last_url']=site_url("board/index/$total_topic");
      $config['base_url']=site_url("board/index");
      $config['first_url']=site_url("board/index/1");
      $this->load->library('pagination');
      $this->pagination->initialize($config);
      $pagination=$this->pagination->create_links();
    }
    else{
      $search_type=$this->input->get('search_type');
      $keyword=$this->input->get('keyword');
      $topic=$this->board_model->get_search($search_type,$keyword,$page, $list);
      $search_topic=$this->board_model->get_search_count($search_type,$keyword);//모든 게시물의 개수
      $config['total_rows']=$search_topic;
      $config['per_page']=$list;
      $config['page_query_string']=false;
      $config['enable_query_string']=true;
      $config['reuse_query_string']=TRUE;
      $config['last_url']=site_url("board/index/$search_topic");
      $config['base_url']=site_url("board/index/1");
      $this->load->library('pagination');
      $this->pagination->initialize($config);
      $pagination=$this->pagination->create_links();
    }
    $this->_head();
    $this->load->view('board',array('topic'=>$topic,'page'=>$page,'pagination'=>$pagination));
    //$this->load->view('board',array('topic'=>$topic));
    $this->_footer();
  }
  public function write()
  {
    if(!$this->session->userdata('is_login')){
      $this->session->set_flashdata('msg','게시물을 작성하려면 로그인이 필요합니다.');
      redirect('/auth/login');
    }
    else{
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
          'errors'=>array('required'=>'본문을 입력해주세요'))
        );
      $this->form_validation->set_rules($rules);
      if($this->form_validation->run()==false){
        $this->_head();
        $this->load->view('write');
        $this->_footer();
      }
      else{
        $this->load->model('board_model');
        $topic=array('title'=>$this->input->post('title'),
          'desc'=>$this->input->post('desc'),
          'user_id'=>$this->session->userdata('id'));
        $id=$this->board_model->write($topic);
        redirect("/board/read/{$id}");
      }
    }
  }
  public function modify($id)
  {
    $this->load->model('board_model');
    $topic=$topic=$this->board_model->read($id);
    if($this->session->userdata('id') != $topic->u_id){
      $this->_head();
      $this->load->view('update_error',array('id'=>$id));
      $this->_footer();
    }
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
        'errors'=>array('required'=>'본문을 입력해주세요'))
      );
    $this->form_validation->set_rules($rules);
    if($this->form_validation->run()==false){
      $this->_head();
      $this->load->view('modify',array('topic'=>$topic,'id'=>$id));
      $this->_footer();
    }
    else{
      $modify_topic=(object)array('title'=>$this->input->post('title'),
        'desc'=>$this->input->post('desc'),
        'id'=>$id);
      $this->board_model->modify($modify_topic);
      redirect(site_url("board/read/$id"));
    }
  }
  public function delete($id)
  {
    $this->load->model('board_model');
    $topic=$this->board_model->read($id);
    if($this->session->userdata('id') != $topic->u_id){
      $this->_head();
      $this->load->view('update_error',array('id'=>$id));
      $this->_footer();
    }
    else
    {
      $this->board_model->delete($id);
      redirect(site_url('board/index/1'));
    }
  }
  public function read($id)
  {
    $this->load->model('board_model');
    $topic=$this->board_model->read($id);
    $reply=$this->board_model->read_reply($id);
    $this->board_model->hits($id);
    $this->_head();
    $this->load->view('read',array('topic'=>$topic));
    $this->load->view('reply',array('id'=>$id,'reply'=>$reply));
    $this->_footer();
  }
  public function read_reply($id)
  {
      $this->load->model('board_model');
      $reply=$this->board_model->read_reply($id);
      $this->_head();
      $this->load->view('reply',array('id'=>$id,'reply'=>$reply));
      $this->_footer();
  }
  public function delete_reply($topic_id,$id)
  {
    $this->load->model('board_model');
    $this->board_model->delete_reply($topic_id,$id);
    redirect("board/read/$topic_id");
  }
  public function write_reply($id)
  {
    $this->load->library('form_validation');
    $rules=array(
      array(
        'field'=>'reply_desc',
        'label'=>'댓글 내용',
        'rules'=>'required',
        'errors'=>array('required'=>'댓글 내용을 입력해주세요.')));

    $this->form_validation->set_rules($rules);
    if($this->form_validation->run()==false){
      redirect(site_url("board/read/$id"));
    }
    else{
      $this->load->model('board_model');
      $reply=(object)array('topic_id'=>$id,'user_id'=>$this->session->userdata('id'),'desc'=>$this->input->post('reply_desc'));
      $this->board_model->write_reply($reply);
      redirect(site_url("board/read/$id"));
    }
  }
  public function index_notice($page)  //공지사항 출력용
  {
    $this->load->library('pagination');
    $list=20;
    $this->load->model('board_model');
    $total_notice=$this->board_model->get_notice_count();
    $notice=$this->board_model->get_notice($page,$list);
    $config['total_rows']=$total_notice;
    $config['per_page']=$list;
    $config['last_url']="http://localhost/coin/dev.php/board/index_notice/{$total_notice}";
    $config['base_url']='http://localhost/coin/dev.php/board/index_notice/';
    $config['first_url']='http://localhost/coin/dev.php/board/index_notice/1';
    $this->pagination->initialize($config);
    $pagination=$this->pagination->create_links();
    $this->_head();
    $this->load->view('board_notice',array('notice'=>$notice,'pagination'=>$pagination));
    $this->_footer();
  }
}
?>
