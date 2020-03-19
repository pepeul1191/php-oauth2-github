<?php
  $code = $_GET['code'];
  if($code == ''){
    header('Location: http://localhost:8080/');
    exit();
  }
  $client_id = 'fbf7599fc982965c892a';
  $client_secret = '1ad6977fa2e876cb48a1ffc3e6a182029811c9ed';
  $url = 'https://github.com/login/oauth/access_token';
  // do post with curl
  $ch = curl_init();
  $post_params = array(
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'code' => $code,
  );
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
  $response = curl_exec($ch);
  $data = json_decode($response);
  curl_close($ch);
  // store token in session
  if($response['access_token'] != ''){
    session_start();
    $_SESSION['access_token'] = $data->access_token;
    header('Location: http://localhost:8080/');
    exit();
  }
?>