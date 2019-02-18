<?php
    session_start();
    if(!isset($_SESSION['login_user']))
    {
        header('location:session_expired.html');
    }
?>
<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, minimum-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <link rel="stylesheet" type="text/css" href="../css/animate.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">

    <script type="text/javascript" src="../resources/csvexport.js"></script>
</head>
<body>
    <div class="main-cont">
        <h1>
            <span class="logo">S</span>
            Sales Details
        </h1>
        
        <div class="row controls">
            <div class="col-sm-6 btn-grp">
                Select Employee
                <select style="margin-left: 30px;" id="select_emp">
                    <?php

                    require('../resources/connect.php');
                    $fetch_emp= "SELECT emp_name from emp";

                    $result=mysqli_query($conn, $fetch_emp);
                    echo "<option selected value='NULL'>- - - </option>";
                    while($rows = mysqli_fetch_assoc($result))
                    {
                        echo "<option value".$rows['emp_name'].">".$rows['emp_name']."</option>";
                    }

                    ?>
                </select>
                
                <br>
                <br>

                Select Range of Days To view Data<br><br>
                <button type="button" duration="24" class="submit_ajax">24 hours</button>
                <button type="button" duration="7" class="submit_ajax">7 days</button>
                <button type="button" duration="30" class="submit_ajax">30 days</button>
                <button type="button" duration="6" class="submit_ajax">6 months</button>
                <button type="button" duration="12" class="submit_ajax">12 months</button>
            </div>

            <div class="col-sm-6">
                Or select Date to Fetch Data<br>
                <input type="date" name="" class="txt-sml" placeholder="Start Date" id="start_date">
                <input type="date" name="" class="txt-sml" placeholder="End Date" id="end_date">
                <button type="button" class="btn-sml" id="fetch_by_date">Fetch</button>
            </div>
        </div>

        <?php

                        
                        $time_difference=86400;
                        date_default_timezone_set("Asia/Kolkata");
                        require('../resources/connect.php');
                        date_default_timezone_set("Asia/Kolkata");
                        $curr_time=time();
                        $req_time= $curr_time - 30*$time_difference;
                        $date=date('dnY');
                        if (!$conn)
                        {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $select_all_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
                        $select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' AND status='done'";
                        $all_data=mysqli_query($conn, $select_all_query);
                        $all_done_data=mysqli_query($conn, $select_all_done_query);

                        $total_count= mysqli_num_rows($all_data);
                        $done_count=  mysqli_num_rows($all_done_data);
                        $unsolved_count=$total_count - $done_count;
                        echo '
                        <div id="result">
                        <table class="custom-table">
                            <tr>
                                <td>Total Complains :</td><td>'.$total_count.'</td>
                                <td>Total Solved Complains :</td><td>'.$done_count.'</td>
                                <td>Total Unsolved Complains :</td><td>'.$unsolved_count.'</td>
                            </tr>
                        </table>


                        <div class="cont table-responsive" style="margin-top: 20px">
                            <input type="text" name="" class="txt-sml" placeholder="Filter Table" id="filter" style="margin-top: 0px;">
                            <button class="btn-sml" style="float: right" id="download_csv">Download As CSV</button>
                            <table class="table" id="content_table">
                                <thead>
                                    <tr>
                                        <td>S. No.</td>
                                        <td>Complain Number</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Company Name</td>
                                        <td>Contact Number</td>
                                        <td> Complain Details</td>
                                        <td>Atendant</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>

                                <tbody id="status">';

                               

                        if($total_count >0)
                        {
                            $sno=1;
                            while($row = mysqli_fetch_assoc($all_data)) 
                            {
                                echo "
                                <tr>
                                    <td>".$sno ."</td>
                                    <td>".$row['complain_no']."</td>
                                    <td>".$row['name']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['company_name']."</td>
                                    <td>".$row['mobno']."</td>
                                    <td>".$row['comp_details']."</td>
                                    
                                    <td>".$row['attendant']."</td>";
                                            
                         
                                        
                                    // *********************************************************************

                                    if($row['status']=='pending')
                                    {
                                       echo "<td><button type='button' class='complain_status pending' name='".$row['complain_no']."' value='pending'><i class='fas fa-exclamation'></i></button></td></tr>";
                                    }
                                    else
                                    {
                                        echo "<td><button type='button' class='complain_status done' name='".$row['complain_no']."' value='done'><i class='fas fa-check'></i></button></td></tr>";
                                    }
                                $sno++;
                        }
                            }
                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>


    </div>
</body>
<script type="text/javascript">
var d = new Date();
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var title_of_document="Data_" + months[d.getMonth()] + "_" + d.getDate();
$('#download_csv').click(function(){
    $('#content_table').csvExport({
        title:title_of_document,
    });
});
$('#fetch_by_date').click(function(){
        var input_start_date= $('#start_date').val();
        var input_end_date= $('#end_date').val();
        var emp_selected=$('#select_emp').val();


        $.ajax({
            type:"POST",
            url:"send_sales_data.php",
            data:{
                duration:'custom',
                start_date: input_start_date,
                end_date: input_end_date,
                emp_selected: emp_selected
            },
            success:function(data)
            {   
                $('#result').empty();
                $('#result').html(data);        
            }
        })
});

$('.submit_ajax').click(function(){
    var emp_selected=$('#select_emp').val();
        
        $.ajax({
            type:"POST",
            url:"send_sales_data.php",
            data:{
                duration:$(this).attr('duration'),
                emp_selected: emp_selected
            },
            success:function(data)
            {
                $('#result').empty();
                $('#result').html(data);        
            }
        })
    });
</script>
</html>