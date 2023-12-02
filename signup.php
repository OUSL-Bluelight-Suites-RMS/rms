<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="Images/logo.png" />
    <title>Sign Up</title>
  </head>
  <body class="signup_body">

    <?php

      $servername = 'localhost';
      $username = 'root';
      $password = '';
      $database = 'rms';

      $connection = new mysqli($servername, $username, $password, $database, 3307);

      if($connection->connect_error){
        die("Connection failed" . $connection->connect_error);
      }

    ?>



    <div class="loginbox_signin">
      <h2 font-size="6">Sign Up</h2>
      <form action="" method="post" target="_self" onsubmit="return validateForm()">
        <fieldset>
          <legend>
            <font size="5"><b>Register</b></font>
          </legend>
          <div class="row">
            <div class="column">
              <label>First Name</label>
              <input
                type="text"
                name="firstname"
                id="firstname"
                placeholder="Enter your first name"
              />
              <br /><br />

              <label>Username</label>
              <input
                type="text"
                name="username"
                id="username"
                placeholder="Enter username"
              />
              <br /><br />

              <label>Password</label>
              <input
                type="text"
                name="password"
                id="password"
                placeholder="8+ chars, including letters, numbers, symbols"
              />

              <br /><br />

              <label>Work ID</label>
              <input
                type="text"
                name="workid"
                id="workid"
                placeholder="Enter Work ID"
              />
            </div>

            <div class="column">
              <label>Last Name</label>
              <input
                type="text"
                name="lastname"
                id="lastname"
                placeholder="Enter your last name"
              />
              <br /><br />
              <label>Email</label>
              <input
                type="text"
                name="email"
                id="email"
                placeholder="Enter a valid email (abc@gmail.com)"
              />

              <br /><br />

              <label>Confirm Password</label>
              <input
                type="text"
                name="cpassword"
                id="cpassword"
                placeholder="Confirm Password"
              />
            </div>
          </div>
          <br /><br />
          <center>
            <input type="submit" name="register" value="Register" />
            <input type="reset" name="reset" value="Reset" />
          </center>
        </fieldset>
      </form>
    </div>

    <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {

        // Get form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $workid = $_POST['workid'];

        // Hash the password (you should use a secure hashing algorithm)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind the SQL statement
        $record = $connection->prepare("INSERT INTO employee (first_name, last_name, username, email, password, work_id) VALUES (?, ?, ?, ?, ?, ?)");
        $record->bind_param("ssssss", $firstname, $lastname, $username, $email, $hashedPassword, $workid);

        // Execute the SQL statement
        if ($record->execute()) {
            header("Location: signin.php");
            echo 'New record entered successfully';
        } else {
            echo 'Error: ' . $record->error;
        }

        // Close the prepared statement
        $record->close();
      }

      $connection->close();

    ?>

    <script src="script.js"></script>

  </body>
</html>
