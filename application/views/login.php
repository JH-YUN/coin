<div class="modal show">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form class="form-group" action='<?=site_url("auth/confirm")."?returnURL=".rawurlencode($returnURL)?>' method="post">
          <div class="form-group">
            <label for="input_email">이메일</label>
            <input id="input_email" class="form-control" type="email" name="email" placeholder="이메일을 입력해주세요">
          </div>
          <div class="form-group">
            <label for="input_password">비밀번호</label>
            <input id="input_password" class="form-control" type="password" name="password" placeholder="비밀번호를 입력해주세요">
          </div>
        <?php
        echo $this->session->flashdata('msg');
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
        <input type="submit" class="btn btn-primary" value="로그인">
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
