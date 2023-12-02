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



<?php
    require('mpdf/vendor/autoload.php');  //Calling the autoload.php file

    $yield = mysqli_query($connection, "SELECT
    CASE
        WHEN QUARTER(wi.start_date) = 1 THEN 'January to March'
        WHEN QUARTER(wi.start_date) = 2 THEN 'April to June'
        WHEN QUARTER(wi.start_date) = 3 THEN 'July to September'
        WHEN QUARTER(wi.start_date) = 4 THEN 'October to December'
    END as season,
    YEAR(wi.start_date) AS year,
    SUM(wi.rb_issue + wi.lb_issue) AS total_issue,
    cd.yield AS yield
    FROM water_issue wi
    INNER JOIN crop_details cd ON wi.start_date = cd.start_date
    WHERE wi.start_date <= NOW()  
    GROUP BY season, year
    ORDER BY year, season
    ");

    if(mysqli_num_rows($yield)>0){   
        $html='<h2 style="text-align:center";>Crop Yield and Water Allocation Report</h2>';  // Heading

        //Set the author
        $html.='<h6>Author : Irrigation Department </h6>';

        //Set the date and time using the default timezone
        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');
        $html.='<h6>Date : '.$currentDateTime.'</h6>';


        // Headings of the table
        $html.='<table style="border-collapse: collapse; width: 100%;">';
            $html.='
            <tr style="background-color: #f2f2f2;">
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Year</td>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Season</td>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Yield</td>     
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Total Issue</td>
            </tr>';

            // Values for the table
            while($row=mysqli_fetch_assoc($yield)){
                $html.=
                '<tr>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['year'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['season'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['yield'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['total_issue'].'</td>
                    
                </tr>';
            }
        $html.='</table>';
    } else{
        $html="Data not found";
    }


    // Locating the Mpdf and writing in a pdf file
    $mpdf=new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    // Saving the file name as the current time
    $file=time().'.pdf';

    // Showing the output as a pdf popup window
    $mpdf->output($file,'I')

?>


