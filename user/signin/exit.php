<?php
  // destroy session
  session_start();
  session_unset();
  // redirect
  header('Location: http://localhost:8080/');
  exit();
?>