<table class="table">
  <tr>
    <th>번호</th>
    <th>제목</th>
    <th>날짜</th>
    <th>조회</th>
    <th>댓글</th>
  </tr>
  <?php foreach($topic as $topic){ ?>
  <tr name="<?=$topic->notice?>">
    <td name="<?=$topic->notice?>1"><?=$topic->id?></td>
    <td ><a name="title" href='<?=site_url("board/read/{$topic->id}")?>'><?=$topic->title?></a></td>
    <td><?=$topic->created?></td>
    <td><?=$topic->hit?></td>
    <td><?=$topic->reply?></td>
  </tr>
<?php } ?>
<script type="text/javascript">
  $("[name=1]").addClass('info');
  $("[name=11]").html('공지');
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
