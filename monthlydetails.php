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
    $monthly = mysqli_query($connection, "SELECT YEAR(start_date) AS year, MONTHNAME(start_date) AS month, SUM(rb_issue) AS total_rb_issue, SUM(lb_issue) AS total_lb_issue
    FROM water_issue
    WHERE start_date <= NOW()
    GROUP BY YEAR(start_date), MONTH(start_date)");

    if(mysqli_num_rows($monthly)>0){   
        $html='<h2 style="text-align:center";>Monthly Detailed Report</h2>'; // Heading

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
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Month</td>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Total RB Issue</td>
                <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Total LB Issue</td>
            </tr>';

            // Values for the table
            while($row=mysqli_fetch_assoc($monthly)){
                $html.=
                '<tr>
                    
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['year'].'</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">'.$row['month'].'</td>
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