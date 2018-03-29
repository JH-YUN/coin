<style>
  .search{
    background-color:yellow;
  }
</style>
<div class="col-xs-9">
  <table class="table">
    <tr>
      <th></th>
      <th>제목</th>
      <th>받은 사람</th>
      <th>시간</th>
    </tr>
<form action="<?=site_url('message/delete')?>?type=send" method="post">
    <?php foreach($message as $message){ ?>
    <tr>
      <td><input name="delete_list[]" value='<?=$message->id?>' type="checkbox"></td>
      <td ><a name="title" href='<?=site_url("message/read/{$message->id}")?>'><?=$message->title?></a></td>
      <td name="name"><?=$message->name?></td>
      <td><?=$message->time?></td>
    </tr>
  <?php } ?>
  <script type="text/javascript">
    <?php if($this->input->get('search_type')=="search_name"){?>
      var search = "<?=$this->input->get('keyword')?>";
      $("[name=name]:contains('"+search+"')").each(function () {
          var regex = new RegExp(search,'gi');
          $(this).html( $(this).text().replace(regex, "<span class='search'>"+search+"</span>") );
      });

    <?php }if($this->input->get('search_type')==("search_title"||"search_title_desc")){?>
      var search = "<?=$this->input->get('keyword')?>";
      $("[name=title]:contains('"+search+"')").each(function () {
          var regex = new RegExp(search,'gi');
          $(this).html( $(this).text().replace(regex, "<span class='search'>"+search+"</span>") );
      });
    <?php } ?>
  </script>
  </table>
  <button id="message-list-delete_btn" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#message-delete_modal">삭제</button>
  <div class="modal fade bs-example-modal-sm" id="message-delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          쪽지를 삭제하시겠습니까?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">아니오</button>
          <input type="submit" class="btn btn-danger btn-sm" value="삭제">
        </div>
      </div>
    </div>
  </div>
</form>
  <form id="board-search" class="form-inline" action='<?=site_url("board/index/1")?>'>
    <div class="form-group">
      <select class="form-control" name="search_type">
        <option value="search_title_desc">제목+내용</option>
        <option value="search_title">제목</option>
        <option value="search_desc">내용</option>
        <option value="search_name">이름</option>
      </select>
      <input type="text" class="form-control" name="keyword" placeholder="쪽지 검색">
      <button type="submit" class="btn btn-default">Search</button>
      </div>
  </form>
    <div id="board-page"><?php echo $pagination ?></div>
</div>
