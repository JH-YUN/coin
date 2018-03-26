<div class="col-xs-9">
  <table class="table message-table">
    <tr>
  		<td class="active">제목</td>
  		<td><?=$message->title?></td>
  	</tr>
    <tr>
      <td class="active">보낸 사람</td>
      <td><?=$message->sender?></td>
    </tr>
    <tr>
      <td class="active">받는 사람</td>
      <td><?=$message->receiver?></td>
    </tr>
  	<tr id="message-desc">
  		<td class="active">내용</td>
  		<td><?=$message->description?></td>
    </tr>
  </table>
</div>
