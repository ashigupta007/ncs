<?php

$duration=$_POST['duration'];
$emp_selected=$_POST['emp_selected'];
$time_difference=86400;
date_default_timezone_set("Asia/Kolkata");


if($duration == 7 )
{
	$curr_time=time();
	$req_time= $curr_time - 7*$time_difference;
	if($emp_selected == 'NULL')
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done'";
	}
	else
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' AND attendant='$emp_selected'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done' AND attendant='$emp_selected'";
	}
}
else if($duration == 24 )
{
	$curr_time=time();
	$req_time= $curr_time - 1*$time_difference;
	if($emp_selected == 'NULL')
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done'";
	}
	else
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' AND attendant='$emp_selected'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done' AND attendant='$emp_selected'";
	}
}
else if($duration == 30 )
{
	$curr_time=time();
	$req_time= $curr_time - 30*$time_difference;
	if($emp_selected == 'NULL')
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done'";
	}
	else
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' AND attendant='$emp_selected'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done' AND attendant='$emp_selected'";
	}
}
else if($duration == 6 )
{
	$curr_time=time();
	$req_time= $curr_time - 180*$time_difference;
	if($emp_selected == 'NULL')
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done'";
	}
	else
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' AND attendant='$emp_selected'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done' AND attendant='$emp_selected'";
	}
}
else if($duration == 12 )
{
	$curr_time=time();
	$req_time= $curr_time - 365*$time_difference;
	if($emp_selected == 'NULL')
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done'";
	}
	else
	{
		$select_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' AND attendant='$emp_selected'";
		$select_all_done_query="SELECT * FROM complain WHERE time_of_submit > '$req_time' and status='done' AND attendant='$emp_selected'";
	}
}
else if ($duration == 'custom') 
{
	$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];

	if($emp_selected == 'NULL')
	{
		$select_query="SELECT * FROM complain WHERE date_submitted between '$start_date' AND '$end_date'";
		$select_all_done_query="SELECT * FROM complain WHERE date_submitted between '$start_date' AND '$start_date' AND status='done'";
	}
	else
	{
		$select_query="SELECT * FROM complain WHERE date_submitted between '$start_date' AND '$end_date' AND attendant='$emp_selected'";
		$select_all_done_query="SELECT * FROM complain WHERE date_submitted between '$start_date' AND '$start_date' AND status='done' AND attendant='$emp_selected'";
	}

}



require('../resources/connect.php');
$all_data=mysqli_query($conn, $select_query);
$all_done_data=mysqli_query($conn, $select_all_done_query);

$total_count= mysqli_num_rows($all_data);
$done_count=  mysqli_num_rows($all_done_data);
$unsolved_count=$total_count - $done_count;

echo '<table class="custom-table">
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