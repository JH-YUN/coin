function CalKrw(usdrate,usdtrate,coin)
{
  //1usdt의 usd가격의 krw단위 출력
  return Math.round(usdrate*usdtrate*coin);
}
function CalPremium(coinkrw,coinusd)
{
  return (((coinkrw-coinusd)*100)/coinusd).toFixed(2);
}


$(function(){
  timer=setInterval(function(){//5초에 한번 ajax
    /*
        DB에 저장된 암호화폐의 시세를 불러옴
{
    "krw": "1071.949951",   //1usd = krw
    "usdt": "1.0021",       //1usdt - usd
    "id": "1",
    "0": {
        "name": "BCH",
        "krw": "1411000",
        "usdt": "1248.99"
    },
    "1": {
        "name": "BTC",
        "krw": "11520000",
        "usdt": "10220"
    },
    "2": {
        "name": "ETH",
        "krw": "993000",
        "usdt": "875.98"
    },
    "3": {
        "name": "LTC",
        "krw": "253900",
        "usdt": "226.29"
    }
}
    */
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'http://ec2-13-124-38-77.ap-northeast-2.compute.amazonaws.com/coin/index.php/update/get_json',
      success: function (data) {
        $('#BTC_bithumb').html(data[1].krw+" KRW");
        $('#BTC_binance').html(CalKrw(data.krw,data.usdt,data[1].usdt)+" KRW");
        $('#BTC_premium').html(CalPremium(data[1].krw,CalKrw(data.krw,data.usdt,data[1].usdt))+" %");
        $('#ETH_bithumb').html(data[2].krw+" KRW");
        $('#ETH_binance').html(CalKrw(data.krw,data.usdt,data[2].usdt)+" KRW");
        $('#ETH_premium').html(CalPremium(data[2].krw,CalKrw(data.krw,data.usdt,data[2].usdt))+" %");
        $('#LTC_bithumb').html(data[3].krw+" KRW");
        $('#LTC_binance').html(CalKrw(data.krw,data.usdt,data[3].usdt)+" KRW");
        $('#LTC_premium').html(CalPremium(data[3].krw,CalKrw(data.krw,data.usdt,data[3].usdt))+" %");
        $('#BCC_bithumb').html(data[0].krw+" KRW");
        $('#BCC_binance').html(CalKrw(data.krw,data.usdt,data[0].usdt)+" KRW");
        $('#BCC_premium').html(CalPremium(data[0].krw,CalKrw(data.krw,data.usdt,data[0].usdt))+" %");
        $('#rate').html("현재 1 USDT의 가격은 "+data.usdt+" USD 입니다.<br>현재 1 USD의 가격은 "+Math.round(data.krw)+" KRW 입니다.");
      },
      error: function () {
      }
    });
  },5000);
});
