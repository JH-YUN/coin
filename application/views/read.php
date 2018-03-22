  <article>
    <table class="table">
      <tr>
        <td colspan='3' class="page-header"><small>제목</small> <?=$topic->title?></td>
      </tr>
      <tr>
        <td><small>작성자</small> <?=$topic->name?></td>
        <td><small>작성시간</small> <?=$topic->t_created?></td>
        <td><small>조회수</small> <?=$topic->hit?></td>
      </tr>
      <tr>
        <td colspan="3"></td>
      </tr>
    </table>
        <?=$topic->description?>
  </article>
  <div id="read-delete_btn">
    <a href='<?=site_url("board/modify/$topic->t_id")?>' class="btn btn-default btn-sm">수정</a>
    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal">삭제</button>
  </div>
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">게시물 삭제</h4>
        </div>
        <div class="modal-body">
          <p>
            게시글을 삭제하시겠습니까?
          </p>
          <div class="alert alert-danger">
            "<?=$topic->title?>" 게시물이 삭제됩니다.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
          <a href='<?=site_url("board/delete/$topic->t_id")?>' class="btn btn-danger">삭제</a>
          </div>
        </div>
      </div>
  </div>
