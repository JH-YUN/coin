<script type="text/javascript">
//5초마다 BTC와 환율값을 받아오는 Ajax
$(function(){
  var btc_krw='loading';
  var btc_usdt='loading';
  var usd='loading';
  var usdt='loading';
  timer=setInterval(function(){
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'http://localhost/coin/dev.php/updatecoin/get_json',
      success: function (data) {
        btc_krw = data.krw;
        btc_usdt= data.usdt;
        // $('#BTC_bithumb').html(data.krw+" KRW");
        // $('#BTC_binance').html(data.usdt+" USDT");
        //alert('현재 BTC 가격은'+BTC+'원이다.');
      },
      error: function () {
          alert('error');
      }
    });
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'http://localhost/coin/dev.php/updaterate/get_json',
      success: function (data) {
        usd= data.krw;
        usdt=data.usdt;
        //alert('현재 USD 가격은'+USD+'원이다.');
      },
      error: function () {
          alert('error');
      }
    });
    $('#BTC_bithumb').html(btc_krw+" KRW");
    $('#BTC_binance').html(btc_usdt*usdt*usd+" KRW");
    $('#premium').html(((btc_krw)-(btc_usdt*usdt*usd))*100/(btc_usdt*usdt*usd)+" %");
  },5000);
});
</script>
<table class="table">
  <tr>
    <th>코인 종류</th>
    <th>국내 가격(Bithumb)</th>
    <th>해외 가격(Binace)</th>
    <th>시세 차이</th>
  </tr>
  <tr>
      <td>BTC</td>
      <td id="BTC_bithumb">loading</td>
      <td id="BTC_binance">loading</td>
      <td id="premium">loading</td>
    </tr>
</table>
