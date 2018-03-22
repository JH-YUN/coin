<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  function kdate_regular($stamp){
    $regular='/([\d]+)-([\d]+)-([\d]+) ([\d]+):([\d]+):([\d]+)/';
    $replacement='$1년 $2월 $3일';
    return preg_replace($regular,$replacement,$stamp);
  }
 ?>
