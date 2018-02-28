<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends MY_Controller {
  function __construct(){
    parent::__construct();
  }
  function update_coin()//10초마다 cron
  {
    $this->load->model('update_model');
    $coin=(object)array("BTC","ETH","BCC","LTC"); //코인 목록
    foreach($coin as $name){
      $coin_USDT=$this->_api_binance($name);
      if($name=="BCC"){$name="BCH";}  //빗썸은 BCC대신 BCH사용
      $coin_KRW=$this->_api_bithumb($name);
      //$this->updatecoin_model->updateBTC($coin_name,$BTCtoKRW,$BTCtoUSDT);
      $this->update_model->update_coin($name,$coin_KRW,$coin_USDT);
    }
  }
  function update_rate()//1시간 cron
  {
    $this->load->model('update_model');
    $result=$this->_api_USDTtoKRW();
    $this->update_model->update_rate($result);
  }
  function _api_bithumb($coin)
  {
    $api='https://api.bithumb.com/public/ticker/';
    $last_api=$api.$coin;
    $result=json_decode(file_get_contents($last_api,true));
    return $result->data->closing_price;//BTC-KRW 현재 시세
  }

  function _api_binance($coin)
  {
    $api='https://api.binance.com/api/v1/ticker/24hr?symbol=';
    $last_api=$api.$coin.'USDT';
    $result=json_decode(file_get_contents($last_api,true));

    return $result->lastPrice;
  }

  function _api_USDTtoKRW()
  {
    $data_USDT=json_decode(file_get_contents('https://api.cryptowat.ch/markets/kraken/usdtusd/price',true));
    $data_KRW=json_decode(file_get_contents('http://api.manana.kr/exchange/rate.json/krw/usd',true));
    $result=array('0'=>$data_USDT->result->price,
                  '1'=>$data_KRW['0']->rate,
                  '2'=>$data_USDT->result->price*$data_KRW['0']->rate);
    return $result;
  }
  function get_json()
  {
    $this->load->model('update_model');
    $result=array_merge($this->update_model->get_rate(),$this->update_model->get_coin());
    echo json_encode($result,JSON_PRETTY_PRINT);

  }
}
?>
