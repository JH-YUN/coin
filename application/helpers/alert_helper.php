<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function alert_location($URL,$msg)
{
  echo "<script>alert('$msg'); window.location='$URL'</script>";
}
function alert($msg)
{
  echo "<script>alert('$msg');</script>";
}
 ?>
