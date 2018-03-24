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
<div id="mypage-profile" class="row">
  <div class="col-md-3">
    <h4>프로필</h4>
  </div>
  <div class="col-md-9">

  </div>
  <div class="col-md-12">
    <form class="" action="<?=site_url('user/update_profile')?>" method="post" enctype="multipart/form-data">
      <?php if(file_get_contents(FCPATH."/static/user_img/$user->id.jpg",FALSE)){?>
      <img id="mypage-profile-img" src="/coin/static/user_img/<?=$user->id?>.jpg" alt="프로필 사진" height="100" width="100">
      <?php }else{ ?>
      <img id="mypage-profile-img" src="/coin/static/user_img/default.jpg" alt="프로필 사진" height="100" width="100">
    <?php } ?>
      <input type="file" name="user_img">
      <h5>허용 확장자 : jpg,png,gif | 2MB 이하</h5>
      <?php if(!empty($this->session->flashdata('err_msg'))){ ?>
      <div class="alert alert-warning">
        <?=$this->session->flashdata('err_msg')?>
      </div>
    <?php } ?>
  </div>
</div>
<div id="mypage-info" class="row">
  <div class="col-md-12">
    <h4>자기 소개</h4>
  </div>
  <div class="col-md-6">
      <textarea class="form-control" name="user_info" rows="3" placeholder="자기소개를 적어주세요" ><?=$user->info?></textarea>
      <input type="submit" class="btn btn-success btn-sm" value="사진 설정 & 작성 완료">
    </form>
  </div>
</div>
<h5>프로필과 자기소개는 게시물 밑에 표시됩니다.</h5>
<h5>이미지의 경우 갱신에 약간의 시간이 걸릴 수 있습니다.</h5>
