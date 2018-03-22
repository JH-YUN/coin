<!DOCTYPE html>
<html>
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="/coin/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="/coin/static/css/style.css">
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
   </head>
   <body>
     <nav id="head-nav" class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=site_url('main')?>"><span>Home</span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li id="head-nav-notice"><a href='<?=site_url("board/index_notice/1")?>'><span>공지</span></a></li>
            <li id="head-nav-index"><a href="<?=site_url('board/index/1')?>"><span>게시판</span> </a></li>
          </ul>
          <form class="navbar-form navbar-left" action='<?=site_url("board/index/1")?>' role="search">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control" name="keyword" placeholder="게시판 검색(제목+내용)">
              <input type="hidden" name="search_type" value="search_title_desc">
              <span class="input-group-btn">
                <button type="submit"  class="btn btn-black"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
              </span>
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if($this->session->userdata('is_login')){
              ?>
             <li><a href="<?=site_url('auth/logout').'?returnURL='.rawurlencode(current_url())?>"><span>Logout</span></a></li>
            <?php
          } else{
            ?>
              <li><a href="<?=site_url('auth/login').'?returnURL='.rawurlencode(current_url())?>"><span>Login</span></a></li>
              <li><a href="<?=site_url('auth/register')?>"><span>회원가입</span></a></li>
            <?php
            }
            ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>마이페이지</span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=site_url('user/mypage')?>"><span>내 정보</span></a></li>
                <li class="divider"></li>
                <li><a href='<?=site_url("user/mytopic/1")?>'><span>내 게시물</span></a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <?php  //특정 페이지에서 네비게이션 바를 보이지 않음
    if($this->uri->segment(2)=='read_reply'){
     ?>
     <script type="text/javascript">
       $('#head-nav').hide();
     </script>
   <?php } ?>
   <script type="text/javascript">
   var navID='<?=$this->uri->segment(2);?>'
   switch (navID) {
     case 'index':
       $('#head-nav-index').attr('class','nav-selected');
       break;
     case 'index_notice':
       $('#head-nav-notice').attr('class','nav-selected');
       break;
   }
   </script>
    <div class="container">
      <?php
      if($this->session->userdata('is_login')){
    echo '<div class="alert alert-info">'.$this->session->userdata('name')." 님 환영합니다.".'</div>';
   }?>
