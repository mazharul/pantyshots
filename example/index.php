<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Charset -->
    <meta charset="utf-8">

    <!-- Meta -->
    <title>Instagram - OAuth Login</title>

    <!-- CSS -->
    <style type="text/css">
      * {
        margin: 0px;
        padding: 0px;
      }

      a.button {
        background: url(instagram-login-button.png) no-repeat transparent;
        cursor: pointer;
        display: block;
        height: 29px;
        margin: 50px auto;
        overflow: hidden;
        text-indent: -9999px;
        width: 200px;
      }

      a.button:hover {
        background-position: 0 -29px;
      }
    </style>
  </head>
  <body>

    <?php
      require '../instagram.class.php';
      
 // Setup class
      $instagram = new Instagram(array(
        'apiKey'      => '08dc3c1f103c4b9693aab4c81a4d9868',
        'apiSecret'   => 'c93445ca19034311950484d5ad744f7e',
        'apiCallback' => 'http://vps.mazharulanwar.com/pantyshots/example/success.php' // must point to success.php
      ));
      
      // Display the login button
      $loginUrl = $instagram->getLoginUrl();
      echo "<a class=\"button\" href=\"$loginUrl\">Sign in with Instagram</a>";
    ?>

  </body>
</html>