
<?php
//10초에 한번 정도 cron 처리
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatecoin extends MY_Controller {
  function __construct(){
    parent::__construct();
  }
  function update($coin_name)//BTC
  {
    $this->load->model('updatecoin_model');
    $BTCtoKRW=$this->_api_bithumb($coin_name);
    $BTCtoUSDT=$this->_api_binance($coin_name);
    //$this->updatecoin_model->updateBTC($coin_name,$BTCtoKRW,$BTCtoUSDT);
    $this->updatecoin_model->update($coin_name,$BTCtoKRW,$BTCtoUSDT);
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
    $this->load->model('updatecoin_model');
    echo json_encode($this->updatecoin_model->get('BTC'));
  }
}
?>
