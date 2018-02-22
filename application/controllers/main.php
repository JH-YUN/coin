<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	public function index()
	{
		$this->load->model('updaterate_model');
		$this->load->model('updatecoin_model');
		$BTCprice=$this->updatecoin_model->get('BTC');	//->krw KRW가격, ->usdt USDT가격
		$USDrate=$this->updaterate_model->get();	//usd 환율 ->krw KRW환율 , ->usdt USDT환율
		$this->_head();
		$this->load->view('main',array(
		'BTCprice'=>$BTCprice,
		'USDrate'=>$USDrate
		));
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
