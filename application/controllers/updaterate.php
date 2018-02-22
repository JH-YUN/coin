<?php
//12시간에 한번 정도 cron 처리
defined('BASEPATH') OR exit('No direct script access allowed');

class Updaterate extends MY_Controller {
  function __construct(){
    parent::__construct();
  }
  function update()//rate
  {
    $result=$this->_api_USDTtoKRW();
    $this->updaterate_model->update($result);
  }
  function _api_USDTtoKRW()
  {
    $this->load->model('updaterate_model');
    $data_USDT=json_decode(file_get_contents('https://api.cryptowat.ch/markets/kraken/usdtusd/price',true));
    $data_KRW=json_decode(file_get_contents('http://api.manana.kr/exchange/rate.json/krw/usd',true));
    $result=array('0'=>$data_USDT->result->price,
                  '1'=>$data_KRW['0']->rate,
                  '2'=>$data_USDT->result->price*$data_KRW['0']->rate);

    return $result;
  }
  function get_json()
  {
    $this->load->model('updaterate_model');
    echo json_encode($this->updaterate_model->get());
  }
}
?>
