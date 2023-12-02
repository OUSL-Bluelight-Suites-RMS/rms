<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="Images/logo.png" />
    <title>Admin Dashboard</title>
  </head>

  

  <body class="admin_body">



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

    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dailyDetailsSubmit'])){

        
          $date = $_POST['today_Date'];
          $water_level = $_POST['water_level'];
          $cwr = $_POST['cwr'];
          $water_evap = $_POST['water_evap'];
          $water_inflow = $_POST['water_inflow'];
        

          $dailyDetails = $connection->prepare("INSERT INTO daily_details (date, water_level, cwr, water_evap, water_inflow) VALUES (?, ?, ?, ?, ?)");
          $dailyDetails->bind_param("sdddd", $date, $water_level, $cwr, $water_evap, $water_inflow);

          if ($dailyDetails->execute()) {
            echo "<script>alert('New record entered successfully!');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
          } else {
            echo 'Error: ' . $dailyDetails->error;
          }

          $dailyDetails->close();
          
          
        

      }
      
      // Entering water details to the database
      if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['waterIssueSubmit'])){

        $startDate = $_POST['s_date'];
        $endDate = $_POST['e_date'];
        $startTime = $_POST['s_time'];
        $endTime = $_POST['e_time'];
        $rbIssue = $_POST['rb_issue'];
        $lbIssue = $_POST['lb_issue'];

        //Inserting form data to the database
        $waterIssue = $connection->prepare("INSERT INTO water_issue (start_date, start_time, end_date, end_time, rb_issue, lb_issue) VALUES (?, ?, ?, ?, ?, ?)");
        $waterIssue->bind_param("ssssdd", $startDate, $startTime, $endDate, $endTime, $rbIssue, $lbIssue);

        //Getting the current date
        $mydate = getdate();
        $nmonth = "$mydate[month]";
        $vmonth = date("m",strtotime($nmonth));;                                                                   
        $todaydate = "$mydate[year]-$vmonth-$mydate[mday]";
        $stringdate = strval($todaydate);  

        //Calculating the total issue for the current date
        $totalIssue = $connection->query("SELECT SUM(rb_issue) + SUM(lb_issue) AS total_issue FROM water_issue WHERE start_date = '$stringdate'");
        $result = $totalIssue->fetch_assoc();
        $totalIssueresult = $result['total_issue'];

        //Getting the crop water requirement for the current date
        $csrValue = $connection->query("SELECT dd.cwr FROM daily_details AS dd JOIN water_issue AS wi ON wi.start_date = dd.date WHERE date = '$stringdate'");
        $csrresult = $csrValue->fetch_assoc();
        $csrResultValue = $csrresult['cwr'];

        //Executing of the form
        $submissionSuccessful = $waterIssue->execute();

        //Checking whether the crop water requirement is greater than total water issue for the day
        if($csrResultValue < $totalIssueresult){
          echo "<script>alert('CSR is less than Total Issue!');</script>";
        } 

        //Alerts to be displayed when the execution occurs
        if($submissionSuccessful){
          echo "<script>alert('New record entered successfully!');</script>";
        } else {
          echo "<script>alert('Error: " . $waterIssue->error . "');</script>";
        }

        //Navigating to the index.php page
        echo "<script>window.location.href = 'index.php';</script>";
      
        //Closing statement
        $waterIssue->close();
      }

    

      //Entering crop details to the database
      if(isset($_POST['cropDetailsSubmit'])){
        $cropEnterDate = $_POST['date'];
        $acreage = $_POST['acreage'];
        $yield = $_POST['yield'];

        //Inserting form data to the database
        $cropDetails = $connection->prepare("INSERT INTO crop_details (start_date, acreage, yield) VALUES (?, ?, ?)");
        $cropDetails->bind_param("sdd", $cropEnterDate, $acreage, $yield);

        //Navigating to the index.php page
        if($cropDetails->execute()){
          echo "<script>alert('New record entered successfully!');</script>";
          echo "<script>window.location.href = 'index.php';</script>";
        } else {
          echo 'Error: ' . $cropDetails->error;
        }

        //Closing statement
        $cropDetails->close();
      }

      //Closing the connection
      $connection->close();

      
    ?>

    <!-- Tabs for the Admin Dashboard -->
    <ul class="tabs">
      <div class="tabs-container">
        <li class="tab" onclick="showPage('page1')">Daily Details</li>
      </div>
      <div class="tabs-container">
        <li class="tab" onclick="showPage('page2')">Water Issuing Details</li>
      </div>
      <div class="tabs-container">
        <li class="tab" onclick="showPage('page3')">Cultivation Details</li>
      </div>
      <div class="tabs-container">
        <li class="tab" onclick="window.location.href='index.php'">Dashboard</li>
      </div>
    </ul>

    <!-- Page 1 -->
    <div id="page1" class="content active">    
      <div class="loginbox_admin_pg1">
        <h2 font-size="6">Daily Details of the Reservoir</h2>
        <form action="" method="post" target="_self" onsubmit="return validateDailyDetailsForm()">
          <fieldset>
            <legend>
              <font size="5"><b>Info</b></font>
            </legend>
            
            <div class="row">
              <div class="column">
                <label>Date</label>
                <input
                  type="text"
                  name="today_Date"
                  id="today_Date"
                  placeholder="YYYY/MM/DD"
                />
                <br /><br />

                <label>Daily Water Level</label>
                <input
                  type="text"
                  name="water_level"
                  id="water_level"
                  placeholder="Enter daily water level (mn m³)"
                />
                <br /><br />

                <label>Crop Water Requirement</label>
                <input
                  type="text"
                  name="cwr"
                  id="cwr"
                  placeholder="Enter crop water requirement (mn m³)"
                />
                <br/><br/>
                  
              </div>

              <div class="column">
                <label>Water Evaporation</label>
                <input
                  type="text"
                  name="water_evap"
                  id="water_evap"
                  placeholder="Enter water evaporation (mn m³)"
                />
                <br /><br />

                <label>Water Inflow</label>
                <input
                  type="text"
                  name="water_inflow"
                  id="water_inflow"
                  placeholder="Enter water inflow level (mn m³)"
                />
                    
              </div>
            </div>
                
            <center>
              <input type="submit" name="dailyDetailsSubmit" value="Submit" />
            </center>
          </fieldset>
        </form>
      </div>   
    </div>

    <!-- Page 2 -->
    <div id="page2" class="content">
      
      <div class="loginbox_admin_pg2">
        <h2 font-size="6">Water Issuing of the Reservoir</h2>
        <form action="" method="post" target="_self" onsubmit="return validateWaterIssueForm()">
          <fieldset>
            <legend>
              <font size="5"><b>Info</b></font>
            </legend>

            <div class="row">
              <div class="column">
                <label>Start Date</label>
                <input
                  type="text"
                  name="s_date"
                  id="s_date"
                  placeholder="YYYY/MM/DD"
                />
                <br /><br />

                <label>End Date</label>
                <input
                  type="text"
                  name="e_date"
                  id="e_date"
                  placeholder="YYYY/MM/DD"
                />          
                <br /><br />

                <label>RB Issue</label>
                <input
                  type="text"
                  name="rb_issue"
                  id="rb_issue"
                  placeholder="Enter RB Issue (mn m³)"
                />              
              </div>

              <div class="column">
                <label>Start Time</label>
                <input
                  type="text"
                  name="s_time"
                  id="s_time"
                  placeholder="HH:mm:ss"
                />
                <br /><br />

                <label>End Time</label>
                <input
                  type="text"
                  name="e_time"
                  id="e_time"
                  placeholder="HH:mm:ss"
                />
                
                <br /><br />
                <label>LB Issue</label>
                <input
                  type="text"
                  name="lb_issue"
                  id="lb_issue"
                  placeholder="Enter LB Issue (mn m³)"
                />
              </div>
            </div>
            
            <center>
              <input type="submit" name="waterIssueSubmit" value="Submit" />
              <input type="reset" name="waterIssueReset" value="Reset" />
              
            </center>
          </fieldset>
        </form>
      </div>
    </div>

    <!-- Page 3 -->
    <div id="page3" class="content">
      
      <div class="loginbox_admin_pg3">
        <h2 font-size="6">Cultivation Details of the Reservoir</h2>
        <form action="" method="post" target="_self" onsubmit="return validateCropDetailsForm()">
          <fieldset>
            <legend>
              <font size="5"><b>Info</b></font>
            </legend>
            <div class="row">
              
                <label>Date</label>
                <input
                  type="text"
                  name="date"
                  id="date"
                  placeholder="YYYY/MM/DD"
                />
                <br /><br />

                <label>Acreage</label>
                <input
                  type="text"
                  name="acreage"
                  id="acreage"
                  placeholder="Enter paddy acreage (ac)"
                />

                <br /><br />

                <label>Yield</label>
                <input
                  type="text"
                  name="yield"
                  id="yield"
                  placeholder="Enter yield (bu/ac⁻¹)"
                />
              </div>
              
            
            <center>
              <input type="submit" name="cropDetailsSubmit" value="Submit" />
            </center>

          </fieldset>
        </form>
      </div>
    </div>
    
    <script src="script.js"></script>
  </body>
</html>
