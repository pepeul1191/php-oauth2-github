<?php
  session_start();
  $session_token = $_SESSION['access_token'];
?>
<html>
  <head>
    <title>Inicio</title>
  </head>
  <body>
    <?php
      echo '<p><b>access token:</b></p>';
      echo '<p><code>' . $session_token . '</code></p>';
      echo '<br>';
      if($session_token != ''){
        echo '<p>Logged in!</p>';
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