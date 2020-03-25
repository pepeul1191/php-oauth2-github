<?php
  session_start();
?>
<html>
  <head>
    <title>Inicio</title>
    <link rel="shortcut icon" href="/public/favicon.ico">
  </head>
  <body>
    <?php
      if($_SESSION['access_token'] != ''){
        echo '<p><b>access token:</b></p>';
        echo '<p><code>' . $_SESSION['access_token'] . '</code></p>';
        echo '<br>';
        echo '<p>Logged in! - ' . $_SESSION['app'] . '</p>';
        echo '<p><b>Usuario</b>: ' . $_SESSION['user_nick'] . '</p>';
        echo '<p><b>Nombre</b>: ' . $_SESSION['user_name'] . '</p>';
        echo '<p><b>Correo</b>: ' . $_SESSION['user_email'] . '</p>';
        echo '<img src="' . $_SESSION['user_img'] . '" height= "200" width="200">';
        $output = '<p>
          <a href="%s" onclick="exitxd()">Salir</a>
        </p>';
        // var_dump($_SESSION['user_data']);
        // var_dump($_COOKIE);
        $href = $_SESSION['logout_url'];
        echo sprintf($output, $href);
      }else{
        // github
        $output = '<p>
          <a href="%s" >Sign In with Github</a>
        </p>';
        $href = 'https://github.com/login/oauth/authorize?client_id=fbf7599fc982965c892a';
        echo sprintf($output, $href);
        // google
        $output = '<p>
          <a href="%s" >Sign In with GMail</a>
        </p>';
        $href = 'https://accounts.google.com/o/oauth2/v2/auth?response_type=code&client_id=1044701093820-jam7g5carn4nghkkhqr75ustq0l5vrum.apps.googleusercontent.com&redirect_uri=http://localhost:8080/user/signin/callback.php?origin=google&scope=profile email';
        echo sprintf($output, $href);
        // facebook
        $output = '<p>
          <a href="%s" >Sign In with Facebook</a>
        </p>';
        $href = 'https://www.facebook.com/v6.0/dialog/oauth?client_id=741726819700614&redirect_uri=http://localhost:8080/user/signin/callback.php?origin=facebook&state={st=state123abc,ds=123456789}';
        echo sprintf($output, $href);
        // instagram
        $output = '<p>
          <a href="%s" >Sign In with Instagram</a>
        </p>';
        $href = 'https://github.com/login/oauth/authorize?client_id=fbf7599fc982965c892a';
        echo sprintf($output, $href);
      }
    ?>
    <script type="text/javascript">
    </script>
  </body>
</html>