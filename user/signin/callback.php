<?php
  // get origin
  $origin = $_GET['origin'];
  // GITHUB
  if($origin == 'github'){
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
    // get user info with token and store it in session
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
      $_SESSION['user_nick'] = $user_data->login;
      $_SESSION['user_name'] = $user_data->name;
      $_SESSION['user_img'] = $user_data->avatar_url;
      $_SESSION['user_email'] = $user_data->email;
      $_SESSION['access_token'] = $data->access_token;
      $_SESSION['app'] = 'Github';
      header('Location: http://localhost:8080/');
      exit();
    }
  }
  if($origin == 'google'){
    // GOOGLE
    $code = $_GET['code'];
    if($code == ''){
      header('Location: http://localhost:8080/');
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
      'redirect_uri' => 'http://localhost:8080/user/signin/callback.php?origin=google', // debe de coincidir con el del sitio web de configuracion
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
      header('Location: http://localhost:8080/');
      exit();
    }
  }

?>