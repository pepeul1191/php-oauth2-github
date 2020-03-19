<?php
  session_start();
?>
<html>
  <head>
    <title>Inicio</title>
  </head>
  <body>
    <?php
      echo '<p><b>access token:</b></p>';
      echo '<p><code>' . $_SESSION['access_token'] . '</code></p>';
      echo '<br>';
      if($_SESSION['access_token'] != ''){
        echo '<p>Logged in!</p>';
        echo '<p><b>Usuario</b>: ' . $_SESSION['user_data']->login . '</p>';
        echo '<p><b>Nombre</b>: ' . $_SESSION['user_data']->name . '</p>';
        echo '<img src="' . $_SESSION['user_data']->avatar_url . '" height= "200" width="200">';
      }else{
        $output = '<p>
          <a href="%s">Sign In with Github</a>
        </p>';
        $href = 'https://github.com/login/oauth/authorize?client_id=fbf7599fc982965c892a';
        echo sprintf($output, $href);
      }
    ?>
  </body>
</html>