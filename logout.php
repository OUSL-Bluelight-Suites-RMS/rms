<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="Images/logo.png" />
    <title>Sign In</title>
  </head>
  <body class="signin_body">

    <?php

    session_start();

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'rms';

    $connection = new mysqli($servername, $username, $password, $database, 3307);

    if($connection->connect_error){
      die("Connection failed" . $connection->connect_error);
    }

    ?>

    <div class="loginbox_logout">
      <center>
        <label>You have been successfully logged out</label>
      </center>
    </div>

    
    <script src="script.js"></script>
  </body>
</html>
