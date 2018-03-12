<style>
  .search{
    background-color:yellow;
  }
</style>
  <table class="table">
    <tr>
      <th>번호</th>
      <th>제목</th>
      <th>작성자</th>
      <th>날짜</th>
      <th>조회</th>
      <th>댓글</th>
    </tr>
    <?php foreach($topic as $topic){ ?>
    <tr name="<?=$topic->notice?>">
      <td name="<?=$topic->notice?>1"><?=$topic->t_id?></td>
      <td name="title"><a href='<?=site_url("board/read/{$topic->t_id}")?>'><?=$topic->title?></a></td>
      <td name="name"><?=$topic->name?></td>
      <td><?=$topic->t_created?></td>
      <td><?=$topic->hit?></td>
      <td></td>
    </tr>
  <?php } ?>
  <script type="text/javascript">
    $("[name=1]").addClass('info');
    $("[name=11]").html('공지');
    <?php if($this->input->get('search_type')=="search_name"){?>
      var search = "<?=$this->input->get('keyword')?>";
      $("[name=name]:contains('"+search+"')").each(function () {
          var regex = new RegExp(search,'gi');
          $(this).html( $(this).text().replace(regex, "<span class='search'>"+search+"</span>") );
      });

    <?php }elseif($this->input->get('search_type')=="search_title"||"search_title_desc"){?>
      var search = "<?=$this->input->get('keyword')?>";
      $("[name=title]:contains('"+search+"')").each(function () {
          var regex = new RegExp(search,'gi');
          $(this).html( $(this).text().replace(regex, "<span class='search'>"+search+"</span>") );
      });
    <?php } ?>
  </script>
  </table>
  <form class="form-inline" action='<?=site_url("board/index/1")?>'>
    <div class="form-group">
      <select class="form-control" name="search_type">
        <option value="search_title_desc">제목+내용</option>
        <option value="search_title">제목</option>
        <option value="search_desc">내용</option>
        <option value="search_name">이름</option>
      </select>
      <input type="text" class="form-control" name="keyword" placeholder="게시판 검색">
      <button type="submit" class="btn btn-default">Search</button>
      </div>
  </form>
    <?php echo $pagination ?>
  <a class="btn btn-primary" href='<?=site_url("board/write/")?>'>글쓰기</a>
