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

    //Creating the query to get details from the database
    $current_quarter = mysqli_query($connection, "SELECT
    CASE 
        WHEN MONTH(NOW()) BETWEEN 1 AND 3 THEN '1' -- Checking the current month
        WHEN MONTH(NOW()) BETWEEN 4 AND 6 THEN '2'
        WHEN MONTH(NOW()) BETWEEN 7 AND 9 THEN '3'
        WHEN MONTH(NOW()) BETWEEN 10 AND 12 THEN '4'
    END AS quarter
    FROM water_issue");

    //Checking the current month, assigning to the respective seasonal group and getting data from the start date upto now
    $seasonal = mysqli_query($connection, "SELECT 
    CASE 
        WHEN QUARTER(start_date) = 1 THEN 'January to March'  
        WHEN QUARTER(start_date) = 2 THEN 'April to June' 
        WHEN QUARTER(start_date) = 3 THEN 'July to September' 
        WHEN QUARTER(start_date) = 4 THEN 'October to December' 
    END AS season,
    YEAR(start_date) AS year,
    SUM(rb_issue) AS total_rb_issue,
    SUM(lb_issue) AS total_lb_issue
    FROM water_issue
    WHERE start_date <= NOW()  
    GROUP BY season, year
    ORDER BY year, season");

    if(mysqli_num_rows($seasonal)>0){   
        $html='<h2 style="text-align:center";>Seasonal Detailed Report</h2>';  // Heading

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
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Total RB Issue</td>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Total LB Issue</td>
            </tr>';

            // Values for the table
            while($row=mysqli_fetch_assoc($seasonal)){
                $html.=
                '<tr>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['year'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['season'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['total_rb_issue'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['total_lb_issue'].'</td>
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



