<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Images/logo.png" />
    <title>Help</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="icons/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
    
  </head>
    
  <body class = "help_body" style="margin:50px;">
    <nav>
      <div class="logo-name">
        <div class="logo-image">
          <img src="images/logo.png" alt="">
        </div>
        <span class="logo_name">RMS</span>
      </div>

      <div class="menu-items">
          <ul class="nav-links">
              
              <li>
                  <a href="index.php">
                      <i class="uil uil-estate"></i>
                      <span class="link-name">Dashboard</span>
                  </a>
              </li>

              <li>
                  <a href="userconfirmation.php">
                      <i class="uil uil-chart"></i>
                      <span class="link-name">Admin Panel</span>
                  </a>
              </li>

              <li>
                  <a href="help.php">
                      <i class="uil uil-comments"></i>
                      <span class="link-name">Help</span>
                  </a>
              </li>
          </ul>
          
          <ul class="logout-mode">
              <li>
                  <a href="logout.php" id="logout">
                      <i class="uil uil-signout"></i>
                      <span class="link-name">Logout</span>
                  </a>
              </li>

              <li class="mode">                   
                  <div class="mode-toggle"></div>     
              </li>
          </ul>
      </div>
    </nav>

    <section class="dashboard1">

      <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
      </div>
        
        
        
      <?php

          //Creating Variables
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "rms";

          //Create Connection
          $connection = new mysqli($servername, $username, $password, $database, 3307);

          //Checking the connection
          if($connection->connect_error){
              die("Connection Failed: " . $connection->connect_error);
          }

      ?>




      <!-- Questions and Answers of the system -->
      <div class = "dash-content">
          
        <h1>How can we help you?</h1>
        <h2>FAQs</h2>


        <button class="accordionButton"><b>Why can't I go to the Admin page?</b></button>
        <div class="panel">
          <p>Only the officers in charge of the system will be able to login to the system. They will be asked a keyword before Sign In or Sign Up in order to grant access. When logging into the system, Username, Password and Work ID must match with the data in the database to continue, or else check the login details and try again.</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Why can't I create a password?</b></button>
        <div class="panel">
          <p>The password should consist of Letters, Numbers and Symbols, and also it should be of minimum 8 characters. So enter a password according to the given instructions.</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>How to create an account?</b></button>
        <div class="panel">
          <p>Only the system officers will be able to create an account. Go to the Admin Page, enter the keyword, then sign in with the relevant data with the correct format and create the account.</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Why does an alert appear when submitting the Daily Details Form?</b></button>
        <div class="panel">
          <p>Enter the data in the relevant format in which the data should be entered. </p>
          <p>Make sure all the entered values are numbers for water level, crop water requirement, water evaporation and water inflow and make sure the date is in the format YYYY-MM-DD and it should be a valid date as well. If there is a character entered other than the required character, an error will be generated</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Why does an alert appear when submitting the Water Issuing Details Form?</b></button>
        <div class="panel">
          <p>Enter the data using the correct format for that. </p>
          <ul> 
            <li>Use Year-Month-Date (2024-01-15) for dates </li>
            <li>Use Hour:Minutes:Seconds(10:20:49) for time</li>
            <li>Numbers for LB & RB issues.</li>
          </ul>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>What are the Functions?</b></button>
        <div class="panel">
          <ul>
            <li>Report can be generated daily, weekly, monthly, seasonally and yearly. Also, the crop yield with water allocation, and the cultivated paddy acreage with crop yield reports, are also generated.</li>
            <li>Data can be inserted</li>
            <li>Alerts will be generated when there is an error</li>
            <li>The system integrates logging control to verify user credentials</li>
          </ul>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>What are the Features?</b></button>
        <div class="panel">
          <p>Dashboard will show,</p>
          <ul>
            <li>Presentation of weather related data</li>
            <li>Presentation of water issue with water inflow as a chart</li>
            <li>The system ensures the protection of data and resources from unauthorized access</li>
            <li>The system is easy to use and navigate</li>
            <li>Report Generation</li>
          </ul>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>How to know that we have successfully logged out?</b></button>
        <div class="panel">
          <p>After you have successfully logged out, the message "You have successfully logged out" will appear on the screen.</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Can I customize the system?</b></button>
        <div class="panel">
          <p>No</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Are there any tutorial available in the system?</b></button>
        <div class="panel">
          <p>No</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Can the system handle real-time reservoir monitoring?</b></button>
        <div class="panel">
          <p>Yes, our Reservoir Management System supports real-time data integration, allowing you to monitor reservoir performance continuously. This feature helps in making timely decisions based on the latest data.</p>
        </div>
        <hr class="short-hr"><br>


        <button class="accordionButton"><b>Are there training resources available for users?</b></button>
        <div class="panel">
          <p>We offer various support options including a dedicated support team.</p>
        </div>
        <hr class="short-hr"><br>


        <script>
          
          //Validate Toggle Function
          const body = document.querySelector("body"),
          modeToggle = body.querySelector(".mode-toggle");
          sidebar = body.querySelector("nav");
          sidebarToggle = body.querySelector(".sidebar-toggle");


          let getStatus = localStorage.getItem("status");
          if(getStatus && getStatus ==="close"){
            sidebar.classList.toggle("close");
          }

          sidebarToggle.addEventListener("click", () => {
              sidebar.classList.toggle("close");
              if(sidebar.classList.contains("close")){
                localStorage.setItem("status", "close");
              }else{
                localStorage.setItem("status", "open");
              }
          })
                
          var acc = document.getElementsByClassName("accordionButton");
          var i;

          for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
              this.classList.toggle("active");
              var panel = this.nextElementSibling;
              if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
              } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
              } 
            });
          }
        </script>


        <!-- Linking the JavaScript File -->
        <script src="script.js"></script>

      </div>
    </section>
  </body>   
</html>  