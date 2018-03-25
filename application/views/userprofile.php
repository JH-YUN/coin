<div class="row">
  <div id="mypage-title" class="col-md-12">
    <h2><?=$user->name?>의 PAGE</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
      <h4><?=$user->name?> 님</h4>
  </div>
  <div class="col-md-3">
      <h5>작성 글  <a href="<?=site_url('board/index/1')?>?search_type=search_name&keyword=<?=$user->name?>" class="btn btn-default btn-xxs"><span class="glyphicon glyphicon-play"></span></a></h5>
      <h4><?=$topic?> 개</h4>
  </div>
  <div class="col-md-3">
      <h5>작성 댓글</h5>
      <h4><?=$reply?> 개</h4>
  </div>
  <div class="col-md-3">
      <h5>가입일</h5>
      <h4><?=kdate_regular($user->created)?></h4>
  </div>
</div>
<div id="mypage-profile" class="row">
  <div class="col-md-3">
    <h4>프로필</h4>
  </div>
  <div id="read-user-profile" class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <?=$user->name?>
      </h4>
    </div>
    <div class="panel-body">
      <div class="row">
          <div id="read-user-profile-img" class="col-md-1">
            <?php if(file_get_contents(FCPATH."/static/user_img/$user->id.jpg",FALSE)):?>
              <img id="mypage-profile-img" src="/coin/static/user_img/<?=$user->id?>.jpg" alt="프로필 사진" height="100" width="100">
            <?php else: ?>
              <img id="mypage-profile-img" src="/coin/static/user_img/default.jpg" alt="프로필 사진" height="100" width="100">
            <?php endif; ?>
          </div>
          <div id="read-user-profile-info" class="col-md-8">
            <br>
            <?=$user->info?>
          </div>
      </div>
    </div>
  </div>
