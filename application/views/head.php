<!DOCTYPE html>
<html>
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="/coin/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
   </head>
   <body>
     <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=site_url('main')?>">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href='<?=site_url("board/index_notice/1")?>'>공지 <span class="sr-only">(current)</span></a></li>
            <li><a href="<?=site_url('board/index/1')?>">게시판 </a></li>
          </ul>
          <form class="navbar-form navbar-left" action='<?=site_url("board/index/1")?>' role="search">
            <div class="form-group">
              <input type="text" class="form-control" name="keyword" placeholder="게시판 검색(제목+작성자)">
              <input type="hidden" name="search_type" value="search_title_desc">
            </div>
            <button type="submit"  class="btn btn-default">Search</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if($this->session->userdata('is_login')){
              ?>
             <li><a href="<?=site_url('auth/logout')?>">Logout</a></li>
            <?php
          } else{
            ?>
              <li><a href="<?=site_url('auth/login').'?returnURL='.rawurlencode(current_url())?>">Login</a></li>
              <li><a href="<?=site_url('auth/register')?>">회원가입</a></li>
            <?php
            }
            ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">마이페이지 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <?php
    if($this->session->userdata('is_login')){ echo $this->session->userdata('name')." 님 환영합니다.";}
    ?>
    <div class="container">
