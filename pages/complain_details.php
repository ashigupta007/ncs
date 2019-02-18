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
</head>
<body>
    <div class="main-cont">
        <h1>
            <span class="logo">C</span>
            Complain Details
        </h1>


        <div class="row controls">
            <form method="POST" action="complain_details.php">
            <div class="col-sm-6 btn-grp">
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

                        require('../resources/connect.php');
                        date_default_timezone_set("Asia/Kolkata");
                        
                        $curr_time=time();
                        $time_difference=86400;
                        if (!$conn)
                        {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $req_time= $curr_time - 1*$time_difference;
                        
                        $select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
                        $select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done'";

                        $all_data=mysqli_query($conn, $select_query);
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
                            <button type="submit" class="btn-sml" style="float: right">Send Email</button>
                            <table class="table">
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

                               
                        $fetch_emp_query= "SELECT * FROM emp";

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
                                    
                                    <td>
                                        <select name=".$row['complain_no']." class='select_attendent'>";
                                    // *********************************************************************
                                        if($row['attendant'] == 'NULL')
                                        {
                                            echo "<option selected value='null'> - - - </option>";
                                            
                                            $fetched_emp=mysqli_query($conn, $fetch_emp_query);
                                            
                                            while($attendant = mysqli_fetch_assoc($fetched_emp))
                                            {
                                                echo "<option value='".$attendant['emp_name']."'>".$attendant['emp_name']."</option>";
                                            }
                                        }
                                        else
                                        {
                                            $fetched_emp=mysqli_query($conn, $fetch_emp_query);
                                            
                                            while($attendant = mysqli_fetch_assoc($fetched_emp))
                                            {
                                                if($row['attendant']===$attendant['emp_name'])
                                                {
                                                    echo "<option value=".$attendant['emp_name']." selected>".$attendant['emp_name']."</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value=".$attendant['emp_name'].">".$attendant['emp_name']."</option>";
                                                }
                                            }
                                        }
                                        
                                    echo "</select></td>";

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
        </form>
        </div>
    </div>
    </div>
<!-- <i class="fas fa-exclamation"></i> -->
</body>

<script type="text/javascript">
    $("#filter").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#status tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    $(document.body).on('click', '.complain_status' ,function(){

        
        if($(this).children().hasClass('fa-check'))
        {
            $(this).children().removeClass('fa-check');
            $(this).children().addClass('fa-exclamation');
            $(this).toggleClass('done');
            $(this).toggleClass('pending');
            //AJAX function first
            $.ajax({
                type: "POST",
                url: 'change_status.php', 
                data: {
                    complain_no:$(this).attr('name'),
                    set_status:'pending',
                },
                success: function(data){
                    if (data == 1)
                    {
                        console.log(data);
                    }
                }
            });
        }
        else
        {
            $(this).children().removeClass('fa-exclamation');
            $(this).children().addClass('fa-check');
            $(this).toggleClass('done');
            $(this).toggleClass('pending');
            $.ajax({
                type: "POST",
                url: 'change_status.php', 
                data: {
                    complain_no:$(this).attr('name'),
                    set_status:'done',
                },
                success: function(data){
                    if (data == 1)
                    {
                        console.log(data);
                    }
                }
            });
        }
    })

    $('.select_attendent').change(function(){
        $.ajax({
                type: "POST",
                url: 'change_attendent.php', 
                data: {
                    complain_no:$(this).attr('name'),
                    set_status:$(this).val(),
                },
                success: function(data){
                    if (data == 1)
                    {
                        console.log('attendant set');
                    }
                }
            });
    });

    $('.submit_ajax').click(function(){
        
        
        $.ajax({
            type:"POST",
            url:"send_complain_data.php",
            data:{
                duration:$(this).attr('duration'),
            },
            success:function(data)
            {
                $('#result').empty();
                $('#result').html(data);        
            }
        })
    });

    $('#fetch_by_date').click(function(){
        var input_start_date= $('#start_date').val();
        var input_end_date= $('#end_date').val();

        $.ajax({
            type:"POST",
            url:"send_complain_data.php",
            data:{
                duration:'custom',
                start_date: input_start_date,
                end_date: input_end_date,
            },
            success:function(data)
            {   
                console.log(input_start_date);
                $('#result').html(data);        
            }
        })
    });
</script>
</html>