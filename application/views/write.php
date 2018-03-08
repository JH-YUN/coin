
<form action="/coin/dev.php/board/write" method="POST">
    <?php validation_errors(); ?>
  <div class="form-group">
    <p><label for="">제목 </label><input class="form-control" type="text" name="title" placeholder="제목을 입력하세요" value="<?=set_value('title')?>"></p>
    <p><label for="">본문</label><textarea class="form-control" name="desc" id="" cols="30" rows="10" placeholder="내용을 입력하세요"value="<?=set_value('desc')?>"></textarea></p>
  </div>
    <input class="btn btn-success" type="submit" name="" value="제출" >
</form>
  <script src="/codeigniter/static/lib/ckeditor/ckeditor.js"></script>
  <!-- <script>
    CKEDITOR.replace('desc',{
      'filebrowserUploadUrl':'/codeigniter/index.php/topic/upload_receive_fromck'
    });
  </script> -->
