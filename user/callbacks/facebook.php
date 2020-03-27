<?php

$code = $_GET['code'];
if($code == ''){
  header('Location: http://localhost:8080/');
  exit();
}
$client_id = '741726819700614';
$client_secret = '8ad88219c6fdc415c38ebb6ded4c1180';
$url = 'https://graph.facebook.com/oauth/access_token';
// do post with curl
$curl_token = curl_init();
$params = array(
  'client_id' => $client_id,
  'client_secret' => $client_secret,
  'code' => $code,
  'grant_type' => 'client_credentials',
  'redirect_uri' => 'http://localhost:8080/user/signin/callback.php?origin=facebook', // debe de coincidir con el del sitio web de configuracion
);
curl_setopt($curl_token, CURLOPT_URL, $url);
curl_setopt($curl_token, CURLOPT_POST, true);
curl_setopt($curl_token, CURLOPT_POSTFIELDS, $params);
curl_setopt($curl_token, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl_token);
$data = json_decode($response);
// var_dump($data);exit();
curl_close($curl_token);
// get user info with token and store it in session
if($data->access_token != ''){
  $curl_user = curl_init();
  var_dump('https://graph.facebook.com/me?fields=name,gender,email,location,picture&access_token=' . $data->access_token);
  curl_setopt($curl_user, CURLOPT_URL, 'https://graph.facebook.com/me?fields=name,gender,email,location,picture&access_token=' . $data->access_token);
  curl_setopt($curl_user, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl_user, CURLOPT_HTTPHEADER, array(
    'Content-type: application/json', 
  ));
  // https://developers.facebook.com/docs/graph-api/reference/user/picture/   
  // https://graph.facebook.com/v6.0/1971263259684582/picture?height=200
  $user_data = json_decode(curl_exec($curl_user));
  var_dump($data->access_token);
  var_dump($user_data);exit();
  curl_close($curl_user);
  session_start();
  $_SESSION['user_data'] = $user_data;
  $_SESSION['access_token'] = $data->access_token;
  $_SESSION['user_nick'] = $user_data->name;
  $_SESSION['user_name'] = $user_data->name;
  $_SESSION['user_img'] = $user_data->picture;
  $_SESSION['user_email'] = $user_data->email;
  $_SESSION['app'] = 'Google';
  $_SESSION['logout_url'] = 'https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost:8080/user/signin/exit.php';
  header('Location: http://localhost:8080/');
  exit();
}

?>