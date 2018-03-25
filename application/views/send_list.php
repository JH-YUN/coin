<style>
  .search{
    background-color:yellow;
  }
</style>
<div class="col-md-10">
  <table class="table">
    <tr>
      <th></th>
      <th>제목</th>
      <th>받은 사람</th>
      <th>시간</th>
    </tr>
    <?php foreach($message as $message){ ?>
    <tr>
      <td></td>
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
  <div id="board-write_btn"><a class="btn btn-danger btn-sm" href='<?=site_url("board/write/")?>'>삭제</a></div>
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
