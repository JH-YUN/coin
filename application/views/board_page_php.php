<?php
$page_num=$page ? $page :1; //현재 page 번호, 빈 값일시 1 을 넣어줌
//$list = 20; //한 page에 보여줄 값
$block_page=5; //블럭에 몇개의 페이지를 넣을것인지
$block_num=ceil($page_num/$block_page);//현재 블럭
$b_start_page=(($block_num-1)*$block_page)+1;//현재 블럭의 시작 page
$b_end_page=$b_start_page+$block_page-1;//현재 블럭의 끝 page
$total_page=ceil($total_topic/$list);//총 페이지 개수 ceil 을 이용해서 1페이지+1게시물 이 될 경우 2페이지까지 만든다.
if($b_end_page>$total_page){//블럭의 마지막 페이지가 총 페이지보다 많다면 마지막 페이지를 총 페이지값으로
  $b_end_page=$total_page;
}
 ?>
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
  <tr>
    <td><?=$topic->t_id?></td>
    <td><a href="/coin/dev.php/board/read/<?=$topic->t_id?>"><?=$topic->title?></a></td>
    <td><?=$topic->name?></td>
    <td><?=$topic->t_created?></td>
    <td><?=$topic->hit?></td>
    <td></td>
  </tr>
  <?php } ?>
</table>
<nav>
  <ul class="pagination">
    <li><a href="/coin/dev.php/board/index/1"> << </a></li>
    <li><a href="/coin/dev.php/board/index/<?=$b_start_page-1?>"> < </a></li>
    <?php for($i=$b_start_page;$i<=$b_end_page;$i++){ ?>
    <li><a href="/coin/dev.php/board/index/<?=$i?>"> <?=$i?> </a></li>
    <?php } ?>
    <li><a href="/coin/dev.php/board/index/<?=$b_end_page+1?>"> > </a></li>
    <li><a href="/coin/dev.php/board/index/<?=$total_page?>"> >> </a></li>
    </ul>
</nav>
