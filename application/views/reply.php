<form class="" action='<?=site_url("board/write_reply/{$id}")?>' method="post">
  <table class="table">
    <caption>댓글 <?=$count?></caption>
    <?php foreach ($reply as $reply) {
    ?>
       <tr class="active">
         <td><?=$reply->name?></td>
         <td><?=$reply->description?></td>
         <td id="reply-created"><?=$reply->r_created?> <a name="<?=$reply->user_id?>" class="label label-default" data-toggle="modal"  data-target='#reply-delete-modal' >삭제</a></td>
       </tr>
       <?php if($reply->user_id!=$this->session->userdata('id')) {
                 ?>
         <script type="text/javascript">
           $('[name="<?=$reply->user_id?>"]').hide();
         </script>
     <?php } ?>
  <?php } ?>
        <tr>
          <td colspan="3"></td>
        </tr>
</table>
<?php if(!$this->session->userdata('is_login')) {
        ?>
  <p>댓글을 작성하려면 로그인 해주세요</p>
  <?php }?>
    <label for="reply_desc">댓글 작성</label>
    <textarea id="reply-desc" class="form-control" name="reply_desc" rows="4" placeholder="댓글을 입력해주세요"></textarea>
    <input class="btn btn-default" type="submit" value="작성">
</form>
<div class="modal fade" id="reply-delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">댓글 삭제</h4>
      </div>
      <div class="modal-body">
        <p>
          댓글을 삭제하시겠습니까?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
        <a href='<?=site_url("board/delete_reply/$id/$reply->r_id")?>' class="btn btn-danger">삭제</a>
        </div>
      </div>
    </div>
</div>
<style>
  #reply-created{
    text-align: right;
  }
  #reply-desc{
    resize: none;
  }
</style>
