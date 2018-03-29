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
  <a class="btn btn-default btn-sm" href="<?=site_url('message/send')?>?receiver=<?=$message->sender?>">답장</a>
</div>
