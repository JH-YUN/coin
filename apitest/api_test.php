<?php

require("./xcoin_api_client.php");

echo 'BTC - KRW<br>';
$api = new XCoinAPI("4eb9af952493fd6dd70c55c9057be231", "dc5789c738fca7f1bf774eda6df7a996");

 $rgParams['order_currency'] = 'BTC';
 $rgParams['payment_currency'] = 'KRW';

$result = $api->xcoinApiCall("/public/ticker", $rgParams);

print_r($result);
echo '<br>';

//바이낸스
echo 'BTC - USDT<br>';
 $data=json_decode(file_get_contents('https://api.binance.com/api/v1/ticker/24hr?symbol=BTCUSDT',true));
 print_r($data);
echo '<br>';

//테더-달러
echo 'USDT - USD<br>';
 $data=json_decode(file_get_contents('https://api.cryptowat.ch/markets/kraken/usdtusd/price',true));
 print_r($data);
echo '<br>';

//달러-원
echo 'USD - KRW<br>';
$data=json_decode(file_get_contents('http://api.manana.kr/exchange/rate.json/krw/usd',true));
print_r($data);
echo '<br>';
/*
$api = new XCoinAPI();
$result = $api->execute("/public/ticker");
echo "status : " . $result->status . "<br />";
echo "last : " . $result->data->closing_price . "<br />";
echo "sell : " . $result->data->sell_price . "<br />";
echo "buy : " . $result->data->buy_price . "<br />";
*/

/*
 * public api
 *
 * /public/ticker
 * /public/recent_ticker
 * /public/orderbook
 * /public/recent_transactions
 */

/*
 * private api
 *
 * endpoint				=> parameters
 * /info/current		=> array('current' => 'btc');
 * /info/account
 * /info/balance		=> array('current' => 'btc');
 * /info/wallet_address	=> array('current' => 'btc');
 */



/*
 * date example
 * 2014-12-30 13:29:49 = 1419913789000
 * 2014-12-29 14:29:49 = 1419830989000
 * 2014-12-23 14:29:49 = 1419312589000
 * 2014-11-30 14:29:49 = 1417325389000
 */

?>
