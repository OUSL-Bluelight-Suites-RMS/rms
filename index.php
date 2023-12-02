<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="Images/logo.png" />
        <title>Dashboard</title>

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
    
    <body style="margin:50px;">

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

        <section class="dashboard">

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

                //Read the data
                $sql = "SELECT * FROM water_issue";
                $result = $connection->query($sql);

                //Checking the query
                if(!$result){
                    die("Invalid Query: " . $connection->error);
                }   

            ?>



            <!--Widget for date, time, country -->
            <div class="dash-content">
                <div class="overview">
                    <div class="current-info">
                        <div class="date-container">
                            <div class="time" id="time">  <!-- Displaying the time -->                     
                                <span id="am-pm"></span>  <!-- Displaying AM or PM -->      
                            </div>
                            <div class="date" id="date">  <!-- Displaying the date -->
                        </div>            
                    </div>
                    <div class="place-container">
                        <div class="time-zone" id="time-zone"></div>  <!-- Displaying the timezone -->
                        <div class="country" id="country"></div>      <!-- Displaying the country -->              
                    </div>
                </div>
            </div>


            <br/>


            <!-- Generate Report --> 
            <div class="dash-content">
                <div class="overview">         
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-download"></i> Generate Report</button>
                        <div class="report_dropdown-content">
                            
                            <div class="dropdown-report-submenu">
                                <div>Water Management</div>
                                <div class="report_dropdown-subcontent">
                                    <div id="daily">Daily Report</div>
                                    <div id="weekly">Weekly Report</div>
                                    <div id="monthly">Monthly Report</div>
                                    <div id="seasonal">Seasonal Report</div>
                                    <div id="yearly">Yearly Report</div>
                                    
                                </div>
                            </div>
                            <div class="dropdown-report-submenu">
                                <div>Paddy Management</div>
                                <div class="report_dropdown-subcontent">
                                    <div id="yield">Crop Yield and Water Allocation Report</div>
                                </div>
                            </div>
                            <div class="dropdown-report-submenu">
                                <div>Agricultural Management</div>
                                <div class="report_dropdown-subcontent">
                                    <div id="acreage">Cultivated Paddy Acreage and Crop Yield Report</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
            

            
            

            <!-- Weather Heading -->
            <div class="dash-content">
                <div class="overview">
                    <div class="shadow1">
                        <div class="title">
                            <i class="uil uil-cloud-sun"></i>
                            <h1>Weather</h1>
                        </div>
                    </div>
                </div>
            </div>
        



            <!-- Displaying the weather widgets for today, tomorrow and day after tomorrow -->
            
            <div class="dash-content">
                <div class="overview">
                    <div class="boxes">
                
                    
                        <!-- Today Weather Widget -->

                        <div class="widget-big" style="box-shadow:  10px 15px 12px lightgrey";>
                            <span class="text" id="day0"></span>
                            <div class="left">       
                                <div class="icon-big" id="icon"></div>       
                            </div>
                            <div class="right">
                                <h5 class="degree" id="feels_like"></h5> 
                                <h5 class="weather-status-big" id="main"></h5>
                            </div>
                            <div class="bottom">
                                <div>
                                    Humidity <span id="humidity"></span>
                                </div>
                                <div>
                                    Wind <span id="speed"></span>
                                </div>
                                <div>
                                    Pressure <span id="pressure"></span>
                                </div>
                            </div>
                        </div>


                        <!-- Tomorrow Weather Widget -->

                        <div class="widget-small" style="box-shadow:  10px 15px 12px lightgrey";>
                            <span class="text" id="day1"></span>
                            <div class="left">       
                                <div class="icon-small" id="iconF"></div>       
                            </div>
                            <div class="right">
                                <h5 class="degree" id="feels_likeF"></h5> 
                                <h5 class="weather-status-small" id="mainF"></h5>
                            </div>
                            <div class="bottom">
                                <div>
                                    Humidity <span id="humidityF"></span>
                                </div>
                                <div>
                                    Wind <span id="speedF"></span>
                                </div>
                                <div>
                                    Pressure <span id="pressureF"></span>
                                </div>
                            </div>
                        </div>


                        <!-- Day after tomorrow Weather Widget -->
                        
                        <div class="widget-small" style="box-shadow:  10px 15px 12px lightgrey";>
                            <span class="text" id="day2"></span>
                            <div class="left">       
                                <div class="icon-small" id="iconF2"></div>       
                            </div>
                            <div class="right">
                                <h5 class="degree" id="feels_likeF2"></h5> 
                                <h5 class="weather-status-small" id="mainF2"></h5>
                            </div>
                            <div class="bottom">
                                <div>
                                    Humidity <span id="humidityF2"></span>
                                </div>
                                <div>
                                    Wind <span id="speedF2"></span>
                                </div>
                                <div>
                                    Pressure <span id="pressureF2"></span>
                                </div>
                            </div>
                        </div>                 
                    </div>     
                </div>
            </div>

            <br/><br/>

            <!-- end of the widget -->


            
            <!--Reservoir Data Heading-->
            <div class="dash-content">
                <div class="overview">
                    <div class="shadow1">
                        <div class="title">
                            <i class="uil uil-tachometer-fast-alt"></i>
                            <h1>Reservoir Data</h1>
                        </div>
                    </div>   
                </div>
            </div>
            
            <br/>



            <!-- Creating Seperate Boxes for Water Capacity, LB Issue and RB Issue -->

            <div class="dash-content">
                <div class="overview">
                    <div class="boxes">
                        <div class="box box1">
                            <i class="uil uil-flip-v-alt"></i>
                            <span class="text">Daily</span>
                            <span class="text">Water Level</span>
                            <span class="text">(mn m³)</span>
                            <span class="number">
                                <?php

                                    //Calculating the date

                                    $mydate = getdate();
                                    $nmonth = "$mydate[month]";
                                    $vmonth = date("m",strtotime($nmonth));;                                                                   
                                    $todaydate = "$mydate[year]-$vmonth-$mydate[mday]";
                                    $stringdate = strval($todaydate);  


                                    //Creating a connection to the database to calculate the current water level

                                    $details = $connection->query("SELECT water_level, water_inflow, water_evap FROM daily_details WHERE date = '$stringdate'");
                                    while($row = $details->fetch_assoc()){                                                       
                                        $current_water_level = $row["water_level"] + $row["water_inflow"] - $row["water_evap"];
                                        echo $current_water_level;                                            
                                    }

                                ?>
                            </span>
                        </div>
                        
                        <div class="box box2">
                            <i class="uil uil-water"></i>
                            <span class="text">Daily Total Water Issue of</span>
                            <span class="text">Right Bank(RB) Canal</span>
                            <span class="text">(mn m³)</span>
                            <span class="number">

                                <?php

                                    //Calculating the SUM of RB Issue
                                    $values_rb = $connection->query("SELECT rb_issue FROM water_issue WHERE start_date = '$stringdate'");
                                    if($values_rb->num_rows > 0){
                                        while($row = $values_rb->fetch_assoc()){                                            
                                                $row["rb_issue"];
                                        }
                                    }


                                    //Displaying the SUM of RB Issue
                                    $values_rb = mysqli_query($connection, "SELECT SUM(rb_issue) FROM water_issue WHERE start_date = '$stringdate'")
                                    or die(mysqli_error());

                                    while($rows = mysqli_fetch_array($values_rb)){
                                        echo
                                        "<tr>
                                            <td>" . $rows["SUM(rb_issue)"] . "</td>
                                        </tr>";
                                    }

                                ?>

                            </span>
                            
                        </div>
                        <div class="box box3">
                            <i class="uil uil-water"></i>
                            <span class="text">Daily Total Water Issue of</span>
                            <span class="text">Left Bank(LB) Canal </span>
                            <span class="text">(mn m³)</span>
                            <span class="number">
                                <?php

                                    //Calculating the SUM of LB Issue 
                                    $values_lb = $connection->query("SELECT lb_issue FROM water_issue WHERE start_date = '$stringdate'");
                                    if($values_lb->num_rows > 0){
                                        while($rows = $values_lb->fetch_assoc()){
                                            $rows["lb_issue"];
                                        }
                                    }

                                    $values_lb = mysqli_query($connection, "SELECT SUM(lb_issue) FROM water_issue WHERE start_date = '$stringdate'")
                                    or die(mysqli_error());



                                    //Displaying the SUM of LB Issue
                                    while($rows = mysqli_fetch_array($values_lb)){
                                        echo
                                        "<tr>
                                            <td>" . $rows["SUM(lb_issue)"] . "</td>
                                        </tr>";
                                    }

                                ?>
                            </span>
                        </div> 
                    </div>
                </div>
            </div>
                
                    


            <br/><br/>

            <!-- Heading for the Chart -->
            <div class="shadow1">
                <div class="dash-content">
                    <div class="overview">
                        <div class="title">
                            <i class="uil uil-chart-line"></i>
                            <h1>Water Issue and Water Inflow By Date</h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <br/><br/>




            <!-- JavaScript Code for the Chart -->
            
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([

                        // Headings for the chart
                        ['Date', 'Water Issue ', 'Water Inflow '],

                        <?php
                            // Setting the default timezone to Asia/Colombo
                            date_default_timezone_set('Asia/Colombo');

                            // Deleting and inserting data into the chart when reloaded
                            $deleting = $connection->query("DELETE FROM chart_table WHERE start_date IS NOT NULL");               
                            $values = $connection->query("INSERT INTO chart_table SELECT start_date,SUM(rb_issue+lb_issue) AS issue FROM water_issue GROUP BY start_date");

                            // Deleting previous data and inserting new data into the joined table
                            $delete_joined_table = $connection->query("DELETE FROM joined_table WHERE start_date IS NOT NULL");
                            $joined_table = $connection->query("INSERT INTO joined_table SELECT DATE(c.start_date),c.issue,d.water_inflow FROM chart_table AS c JOIN daily_details AS d ON c.start_date = d.date ");   
                            
                            //Selecting data from the joined table, sort it into descending order by start date and limit it to 30 data
                            $result_joined = "SELECT * FROM joined_table ORDER BY start_date DESC LIMIT 30";
                            
                            //Creating a query for the resultant joined table                    
                            $final_joined = mysqli_query($connection,$result_joined);




                            // Fetching data and displaying on the chart

                            // Create an empty array to store the data points
                            $data_array = array(); 

                            //Fetching data and converted them to string, and fetching issue and water inflow
                            while ($result1 = mysqli_fetch_assoc($final_joined)) {
                                $date = "'" . date('d-M-Y', strtotime($result1['start_date'])) . "'";
                                $issue = $result1['issue'];
                                $water_inflow = $result1['water_inflow'];
                            
                                // Store the data point in an array
                                $data_point = "[$date, $issue, $water_inflow]";
                                
                                // Add the data point to the beginning of the data array
                                array_push($data_array, $data_point);
                            }
                            
                            // Reverse the order of the data points in the data array
                            $data_array = array_reverse($data_array);
                            
                            // Loop through the data array and output the chart data
                            foreach ($data_array as $data_point) {
                                echo $data_point . ",";
                            }
                        
    
                        ?>
                    
                    ]);

                    var options = {
                        title: 'Water Issue and Water Inflow Forecast',
                        curveType: 'function',
                        legend: { position: 'bottom' },
                        hAxis: {
                            format: 'dd-MMM',                   // Display date in day, Month, year format
                            gridlines: { count: 12 },           // Display gridlines for each month
                            minorGridlines: { count: 0 },       // Don't display minor gridlines
                            title: 'Date',
                        },
                        vAxis: {
                            title: 'Volume (mn m³)',
                        },
                        //Formatting the tooltip
                        tooltip: {
                            isHtml: true,
                            textStyle: { 
                                color: 'black',
                                fontSize: 14,
                                bold: true
                            },

                            // Use a custom formatter to add a space between the title and value
                            formatter: function(tooltipItem, data) {
                                var title = data.getColumnLabel(tooltipItem.column);
                                var value = data.getValue(tooltipItem.row, tooltipItem.column);
                                return '<div style="padding: 4px;"><strong>' + title + ': </strong>' + value + '</div>';
                            }
                        }
    
                    };

                    //Displaying the chart 
                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                    chart.draw(data,options);
                }
            </script>
            <!-- End of the JavaScript Code for the Chart -->

            <!-- Formatting the Chart  --> 
            <div id="curve_chart" 
                style=
                "
                
                    height: 600px; 
                    box-shadow:  5px 10px 8px lightgrey;
                    border-style: solid;
                    color: Gainsboro;
                    width: calc(100%);
                    
                    
                ">
            </div>
            <br/><br/>




            <!-- Displaying the water issue table -->

            <!-- Water Issue Heading -->
            <div class="dash-content">
                <div class="overview">
                    <div class="shadow1">
                        <div class="title">
                            <i class="uil uil-clock-three"></i>
                            <h1>Water Issue</h1>
                        </div>
                    </div>
                </div>
            </div>

            <br/><br/>

            <!-- Formatting the table -->
            <table class="table" 
                style="
                    box-shadow: 10px 15px 12px lightgrey;
                    border-style: solid;
                    padding: 15px;
                "> 
                

                <!-- Table Headings -->
                <thead>
                    <tr>
                        <th>Start Date <br/>(YYYY-MM-DD)</th>
                        <th>Start Time <br/>(HH:mm:ss)</th>
                        <th>End Date <br/>(YYYY-MM-DD)</th>
                        <th>End Time <br/>(HH:mm:ss)</th>
                        <th>RB Issue <br/>(mn m³)</th>
                        <th>LB Issue <br/>(mn m³)</th>
                    </tr>
                </thead>


                <!-- Table Body -->
                <tbody>
                    <?php

                        //Read data from each row and limit upto 10 records
                        $data = mysqli_query($connection, "SELECT * FROM water_issue ORDER BY start_date DESC LIMIT 10");

                        // Display the data in reverse order
                        $rows = array_reverse(mysqli_fetch_all($data, MYSQLI_ASSOC));
                        foreach ($rows as $row) {
                            echo 
                                "<tr>
                                    <td>" . $row["start_date"] . "</td>
                                    <td>" . $row["start_time"] . "</td>
                                    <td>" . $row["end_date"] . "</td>
                                    <td>" . $row["end_time"] . "</td>
                                    <td>" . $row["rb_issue"] . "</td>
                                    <td>" . $row["lb_issue"] . "</td>
                                </tr>";
                        }


                    ?>
                </tbody>
            </table>     
            


            <!-- Linking the JavaScript File -->
            <script src="script.js"></script>

        </section>
    </body>   
</html>  