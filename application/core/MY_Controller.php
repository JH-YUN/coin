<?php
//모든 모듈에서 사용되는 함수를 재정의 하기 위해 CI_Controller를 상속받는 MY_Controller를 만들고
//MY_Controller의 내용에 추가
class MY_Controller extends CI_Controller{
  function __construct(){
    parent::__construct();
  }
  function _head(){
    $this->load->view('head');
  }
  function _footer(){
    $this->load->view('footer');
  }
}
 ?>
