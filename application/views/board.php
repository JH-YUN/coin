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
      <td><a href='<?=site_url("board/read/{$topic->t_id}")?>'><?=$topic->title?></a></td>
      <td><?=$topic->name?></td>
      <td><?=$topic->t_created?></td>
      <td><?=$topic->hit?></td>
      <td></td>
    </tr>
    <?php if($topic->notice){?>

  <?php }} ?>
  <script type="text/javascript">
    $("[name=1]").addClass('info');
    $("[name=11]").html('공지');
  </script>
  </table>
    <?php echo $pagination ?>
  <a class="btn btn-primary" href='<?=site_url("board/write/")?>'>글쓰기</a>
