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
  $curl_token = curl_init();
  $post_params = array(
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'code' => $code,
  );
  curl_setopt($curl_token, CURLOPT_URL, $url);
  curl_setopt($curl_token, CURLOPT_POST, true);
  curl_setopt($curl_token, CURLOPT_POSTFIELDS, $post_params);
  curl_setopt($curl_token, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl_token, CURLOPT_HTTPHEADER, array('Accept: application/json'));
  $response = curl_exec($curl_token);
  $data = json_decode($response);
  curl_close($curl_token);
  // store token in session
  if($response['access_token'] != ''){
    $curl_user = curl_init();
    curl_setopt($curl_user, CURLOPT_URL, 'https://api.github.com/user');
    curl_setopt($curl_user, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_user, CURLOPT_HTTPHEADER, array(
      'User-Agent: request', 
      'Authorization: token ' . $data->access_token,
    ));
    $user_data = json_decode(curl_exec($curl_user));
    curl_close($curl_user);
    session_start();
    $_SESSION['user_data'] = $user_data;
    $_SESSION['access_token'] = $data->access_token;
    header('Location: http://localhost:8080/');
    exit();
  }
?>