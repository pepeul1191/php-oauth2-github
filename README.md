# OAuth PHP - Github

Arrancar servidor PHP:

    $ php -S localhost:8080

Crear OAuth en Github:

1. Una vez logueado en github, usar el siguiente código, entrar a la url 'https://github.com/settings/apps'. 
2. Ir a la ventana 'OAuth Apps' y dar click en 'Register a new application'.
3. Llenar los campos del formulario, indicando en 'Homepage URL' la ruta de la aplicación, así sea en localhost incluyendo el protocolo.
4. Llenar 'Authorization callback URL' agregando una ruta de callback que incluya 'Homepage URL'.
5. Clickear 'Register application'

Una vez creada la aplicación OAuth, se puede cambiar la imagen.

Los pasos que debe de seguir OAuth está en la fuente 2.

Para obtener los datos de usuario:

    $ curl -H "Authorization: token TOKEN_ACCESS" https://api.github.com/user

Ver cookies en chrome 'chrome://settings/siteData'.

Como funciona la lógica del logout está en la fuente 5.

---

Fuentes:

+ https://www.youtube.com/watch?v=2-5j7rvQgBo
+ https://developer.github.com/apps/building-oauth-apps/authorizing-oauth-apps/
+ https://developer.github.com/v3/oauth_authorizations/
+ https://voragine.net/weblogs/como-hacer-una-peticion-post-a-un-servidor-usando-curl-en-un-script-php
+ https://stackoverflow.com/questions/12909332/how-to-logout-of-an-application-where-i-used-oauth2-to-login-with-google
