<?php

include('../../configs/constants.php');

$code = $_GET['code'];
if($code == ''){
  header('Location: ' . BASE_URL);
  exit();
}
$client_id = '1044701093820-jam7g5carn4nghkkhqr75ustq0l5vrum.apps.googleusercontent.com';
$client_secret = '_gRRhQeMc6HKcCWum1hprRhy';
$url = 'https://oauth2.googleapis.com/token';
// do post with curl
$curl_token = curl_init();
$params = array(
  'client_id' => $client_id,
  'client_secret' => $client_secret,
  'code' => $code,
  'grant_type' => 'authorization_code',
  'redirect_uri' => BASE_URL . 'user/signin/callback.php?origin=google', // debe de coincidir con el del sitio web de configuracion
);
curl_setopt($curl_token, CURLOPT_URL, $url);
curl_setopt($curl_token, CURLOPT_POST, true);
curl_setopt($curl_token, CURLOPT_POSTFIELDS, $params);
curl_setopt($curl_token, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl_token);
$data = json_decode($response);
curl_close($curl_token);
// get user info with token and store it in session
if($data->access_token != ''){
  $curl_user = curl_init();
  curl_setopt($curl_user, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $data->access_token);
  curl_setopt($curl_user, CURLOPT_RETURNTRANSFER, true);
  $user_data = json_decode(curl_exec($curl_user));
  curl_close($curl_user);
  session_start();
  $_SESSION['user_data'] = $user_data;
  $_SESSION['access_token'] = $data->access_token;
  $_SESSION['user_nick'] = $user_data->name;
  $_SESSION['user_name'] = $user_data->name;
  $_SESSION['user_img'] = $user_data->picture;
  $_SESSION['user_email'] = $user_data->email;
  $_SESSION['app'] = 'Google';
  $_SESSION['logout_url'] = 'https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue=' . BASE_URL . 'user/signin/exit.php';
  header('Location: ' . BASE_URL);
  exit();
}

?>