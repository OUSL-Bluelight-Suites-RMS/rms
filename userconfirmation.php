<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="Images/logo.png" />
    <title>User Confirmation</title>
  </head>

  <body class="user_confirmation_body">

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

    <div class="loginbox_user_confirmation">
      <h2 font-size="6">User Confirmation</h2>
      <form action="" method="post" target="_self" onsubmit="return validateKeyword()">
        <fieldset>
          <legend>
            <font size="5"><b>Confirmation</b></font>
          </legend>
          <div class="row">
            
              
              <br /><br />

              <label>Keyword</label>
              <input
                type="text"
                name="keyword"
                id="keyword"
                placeholder="Enter the keyword"
              />
              <br /><br />

              
            

            
          </div>
          <br />
          <center>
            <input type="submit" name="keywordConfirm" value="Submit" />
            <a href="index.php" class = "signin_up_button">Back</a>
            
            
          </center>
        </fieldset>
      </form>
    </div>


    <?php
      
      if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['keywordConfirm'])){

        $keyword = $_POST['keyword'];

        if($keyword !== 'irrigation'){
            echo '<script>alert("The entered keyword is incorrect");</script>';
            return false;
        } else {
          header('Location: signin.php');
          exit();
        }
      };
      

    ?> 

    
    <script src="script.js"></script>
    
  </body>
</html>
