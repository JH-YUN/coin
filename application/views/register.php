  <form class="" action="<?=site_url('auth/register')?>" method="post">
    <?php echo validation_errors(); ?>
    <div class="form-group">
      <label class="control-label" for="register_email">이메일</label>
      <input id="register_email" class="form-control" type="email" name="email" value="<?php echo set_value('email');?>" placeholder="example@example.com">
    </div>
    <div class="form-group">
      <label class="control-label" for="register_email">비밀번호</label>
      <input id="register_password" class="form-control" type="password" name="password" value="<?php echo set_value('password');?>">
    </div>
    <div class="form-group">
      <label class="control-label" for="register_email">비밀번호 확인</label>
      <input id="register_password_verify" class="form-control" type="password" name="password_verify">
    </div>
    <div class="form-group">
      <label class="control-label" for="register_email">닉네임</label>
      <input id="register_name" class="form-control" type="text" name="name" value="<?php echo set_value('name');?>">
    </div>
    <input class="btn btn-success" type="submit" name="" value="회원가입">
  </form>
