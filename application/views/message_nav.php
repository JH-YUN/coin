<script>
  $('#head-nav').hide();
  $('.alert').hide();
</script>
<div class="page-header">
  <h3>쪽지함 <small></small></h3>
</div>

<div id="message-nav" class="col-xs-3">
  <ul class="nav nav-pills nav-stacked" role="tablist">
    <li name="send"><a href="<?=site_url('message/send')?>">쪽지 보내기</a></li>
    <li name="receive-list"><a href="<?=site_url('message/receive_list/1')?>">받은 쪽지</a></li>
    <li name="send-list"><a href="<?=site_url('message/send_list/1')?>">보낸 쪽지</a></li>
  </ul>
</div>
<script>
  <?php if($this->uri->segment(2)=='send'): ?>
    $('[name=send]').addClass("active");
    $('small').html('보내기');
  <?php elseif($this->uri->segment(2)=='receive_list'): ?>
    $('[name=receive-list]').addClass("active");
    $('small').html('받은 쪽지함');
  <?php elseif($this->uri->segment(2)=='send_list'): ?>
    $('[name=send-list]').addClass("active");
    $('small').html('보낸 쪽지함');
  <?php endif; ?>
</script>
