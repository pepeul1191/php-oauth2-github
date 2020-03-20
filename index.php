<?php
  session_start();
?>
<html>
  <head>
    <title>Inicio</title>
  </head>
  <body>
    <?php
      if($_SESSION['access_token'] != ''){
        echo '<p><b>access token:</b></p>';
        echo '<p><code>' . $_SESSION['access_token'] . '</code></p>';
        echo '<br>';
        echo '<p>Logged in!</p>';
        echo '<p><b>Usuario</b>: ' . $_SESSION['user_data']->login . '</p>';
        echo '<p><b>Nombre</b>: ' . $_SESSION['user_data']->name . '</p>';
        echo '<img src="' . $_SESSION['user_data']->avatar_url . '" height= "200" width="200">';
        $output = '<p>
          <button onclick="exit()"> salir???</button>
          <a href="%s" onclick="exitxd()">Salir</a>
        </p>';
        // var_dump($_SESSION['user_data']);
        // var_dump($_COOKIE);
        $href = 'http://localhost:8080/user/signin/exit.php';
        echo sprintf($output, $href);
      }else{
        $output = '<p>
          <a href="%s" >Sign In with Github</a>
        </p>';
        $href = 'https://github.com/login/oauth/authorize?client_id=fbf7599fc982965c892a';
        echo sprintf($output, $href);
      }
    ?>
    <script>
      function exit(){
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            console.log(name);
            // document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        }
      }
    </script>
  </body>
</html>