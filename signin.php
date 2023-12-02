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

    <div class="loginbox_signup">
      <h2 font-size="6">Sign In</h2>
      <form action="" method="post" target="_self" onsubmit="return validateSignInForm()">
        <fieldset>
          <legend>
            <font size="5"><b>Login</b></font>
          </legend>
          <div class="row">
            
              
              <br /><br />

              <label>Username</label>
              <input
                type="text"
                name="usernameSI"
                id="usernameSI"
                placeholder="Enter username"
              />
              <br /><br />

              <label>Password</label>
              <input
                type="text"
                name="passwordSI"
                id="passwordSI"
                placeholder="Enter password"
              />

              <br /><br />

              <label>Work ID</label>
              <input
                type="text"
                name="workidSI"
                id="workidSI"
                placeholder="Enter Work ID"
              />
            

            
          </div>
          <br />
          <center>
            <input type="submit" name="signin" value="Sign In" />
            <a href="signup.php" class = "signin_up_button">Sign Up</a>
            
          </center>
        </fieldset>
      </form>
    </div>

    <?php
      
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin'])) {
        $username = $_POST['usernameSI'];
        $password = $_POST['passwordSI'];
        $workid = $_POST['workidSI'];
    
        // Using prepared statement to prevent SQL injection
        $stmt = $connection->prepare("SELECT * FROM employee WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            // Verify the hashed password
            if (password_verify($password, $user["password"]) && $user["work_id"] == $workid) {
                // Credentials are valid, log in the user
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["workid"] = $user["work_id"];
    
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "Invalid Credentials";
            }
        } else {
            echo "User not found";
        }
    
        $stmt->close();
      }
    
      $connection->close();

    ?>
    <script src="script.js"></script>
    
  </body>
</html>
