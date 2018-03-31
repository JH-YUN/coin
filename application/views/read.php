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
    <div id="read-desc">
      <?=$topic->description?>
    </div>
    <div id="read-user-profile" class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <?=$topic->name?>
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
              ... <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?=site_url('user/userprofile')?>?user=<?=$topic->u_id?>">유저 정보</a></li>
              <li><a href="<?=site_url('board/index/1')?>?search_type=search_name&keyword=<?=$topic->name?>">작성글 검색</a></li>
              <li><a href="<?=site_url('message/send')?>?receiver=<?=$topic->name?>">쪽지 보내기</a></li>
            </ul>
          </div>
        </h4>
      </div>
      <div class="panel-body">
        <div class="row">
            <div id="read-user-profile-img" class="col-md-1">
              <?php if(file_get_contents(FCPATH."/static/user_img/$topic->u_id.jpg",FALSE)){?>
              <img src="/coin/static/user_img/<?=$topic->u_id?>.jpg" alt="프로필 사진" height="100" width="100">
              <?php }else{ ?>
              <img src="/coin/static/user_img/default.jpg" alt="프로필 사진" height="100" width="100">
              <?php } ?>
            </div>
            <div id="read-user-profile-info" class="col-md-8">
              <br>
              <?=$topic->info?>
            </div>
        </div>
      </div>
    </div>
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
