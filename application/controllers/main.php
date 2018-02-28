<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	public function index()
	{
		$this->_head();
		$this->load->view('main');
    $this->_footer();
	}
	public function board()
	{
		$this->_head();
		$this->load->view('board');
		$this->_footer();
	}
	public function board_notice()
	{
		$this->_head();
		$this->load->view('board_notice');
		$this->_footer();
	}
	public function write()
	{
		$this->load->library('form_validation');
		$this->_head();
		$this->load->view('write');
		$this->_footer();
	}

}
?>
