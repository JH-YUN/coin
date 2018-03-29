function startInterval(seconds, callback) {
	callback();
	return setInterval(callback, seconds * 1000);
}
//setInterval의 내용을 한번 실행하고 delay 시작
$(function() {
	timer = startInterval(60, function() { //1분에 한번 ajax
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: 'http://180.71.252.131/coin/index.php/message/notice',
			success: function(data) {
        if(!(data == 0)){
          $('#head-nav_badge').html('N');
  				$('#head-nav-message_badge').html(data);
        }
        else{
          $('#head-nav_badge').empty();
          $('#head-nav-message_badge').empty();
        }
			},
			error: function() {}
		});
	});
});


//<span id="head-nav_badge" class="badge"></span>
//<span id="head-nav-message_badge" class="badge"></span>
