<form class="" action='<?=site_url("board/write_reply/{$id}")?>' method="post">
  <?php foreach($reply as $reply){  ?>
     <p>
       <?=$reply->name?> | <?=$reply->r_created?> |<?=$reply->description?>
       <a id="reply_delete" class="label label-default" href='<?=site_url("board/delete_reply/$id/$reply->r_id")?>'>댓글 삭제</a>
     </p>
  <?php
}if(!$this->session->userdata('is_login')){
    ?>
    <p>댓글을 작성하려면 로그인 해주세요</p>
  <?php } else{ ?>
  <label for="reply_desc">댓글 작성</label>
  <textarea id="reply_desc" class="form-control" name="reply_desc" rows="8" cols="80" placeholder="댓글을 입력해주세요"></textarea>
  <input class="btn btn-success" type="submit" value="작성">
  <?php if($reply->user_id!=$this->session->userdata('id')){?>
    <script type="text/javascript">
      $('#reply_delete').hide();
    </script>
<?php }} ?>
</form>
