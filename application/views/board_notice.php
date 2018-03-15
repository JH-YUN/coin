<table class="table">
  <tr>
    <th>번호</th>
    <th>제목</th>
    <th>작성자</th>
    <th>날짜</th>
    <th>조회</th>
    <th>댓글</th>
  </tr>
  <?php foreach($notice as $topic){ ?>
  <tr>
    <td><?=$topic->t_id?></td>
    <td><a href='<?=site_url("board/read/{$topic->t_id}")?>'><?=$topic->title?></a></td>
    <td><?=$topic->name?></td>
    <td><?=$topic->t_created?></td>
    <td><?=$topic->hit?></td>
    <td><?=$topic->reply?></td>
  </tr>
  <?php } ?>
</table>
  <?php echo $pagination ?>
