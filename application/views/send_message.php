<div class="col-md-10">


  <form action="<?=site_url('message/send')?>" method="POST">
    <?php if(!empty(validation_errors()))
      alert(form_error('title',' ','\n').form_error('receiver',' ','\n').form_error('desc',' ',' '));
    ?>
    <div class="form-group">
      <p><label for="">제목</label><input class="form-control" type="text" name="title" placeholder="제목을 입력하세요" value="<?=set_value('title')?>"></p>
      <?php if(empty($this->input->get('receiver'))): ?>
        <p><label for="">받는 사람</label><input class="form-control" type="text" name="receiver" placeholder="이름을 입력하세요" value="<?=set_value('receiver')?>"></p>
      <?php else: ?>
        <p><label for="">받는 사람</label><input class="form-control" type="text" name="receiver" placeholder="이름을 입력하세요" value="<?=$this->input->get('receiver')?>"></p>
      <?php endif; ?>
      <p><label for="">본문</label><textarea class="form-control" name="desc" id="desc" cols="30" rows="10" placeholder="내용을 입력하세요" value=""><?=set_value('desc')?></textarea></p>
    </div>
      <input class="btn btn-success" type="submit" name="" value="보내기" >
  </form>
</div>

<script src="/coin/static/ckeditor/ckeditor.js"></script>
<script>
var config={};
config.extraPlugins='confighelper';
config.placeholder='내용을 입력하세요';
config.filebrowserUploadUrl='/coin/dev.php/board/upload_img';
  // CKEDITOR.replace('desc',{
  //   'filebrowserUploadUrl':'/codeigniter/index.php/topic/upload_receive_fromck'
  // });
CKEDITOR.replace('desc',config);
</script>
