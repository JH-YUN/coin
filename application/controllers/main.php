<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	public function index()
	{
		$this->_head();
		$this->load->view('main');
    $this->_footer();
	}
	public function login()
	{
		$this->_head();
		$this->load->view('login');
		$this->_footer();
	}

}
?>
