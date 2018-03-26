<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_delete extends MY_Controller {
  function __construct(){
    parent::__construct();
  }
	function process()
	{
		$this->load->model('message_model');
    $this->message_model->delete_cli();
	}
}
?>
