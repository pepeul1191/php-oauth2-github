<?php
  // get origin
  $origin = $_GET['origin'];
  // go to callbacks to set session variables
  if($origin == 'github'){
    include(dirname(__DIR__).'/callbacks/github.php');
  }
  if($origin == 'google'){
    include(dirname(__DIR__).'/callbacks/google.php');
  }
  if($origin == 'facebook'){
    include(dirname(__DIR__).'/callbacks/facebook.php');
  }
  if($origin == 'instagram'){
    include(dirname(__DIR__).'/callbacks/instagram.php');
  }

?>