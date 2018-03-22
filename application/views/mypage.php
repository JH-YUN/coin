<div class="row">
  <div id="mypage-title" class="col-md-12">
    <h2>MY PAGE</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
      <h4><?=$user->name?> 님</h4>
      <h5><?=$user->email?></h5>
  </div>
  <div class="col-md-3">
      <h5>작성 글  <a href="<?=site_url('user/mytopic/1')?>" class="btn btn-default btn-xxs"><span class="glyphicon glyphicon-play"></span></a></h5>
      <h4><?=$mytopic?> 개</h4>
  </div>
  <div class="col-md-3">
      <h5>작성 댓글</h5>
      <h4><?=$myreply?> 개</h4>
  </div>
  <div class="col-md-3">
      <h5>가입일</h5>
      <h4><?=kdate_regular($user->created)?></h4>
  </div>
</div>
