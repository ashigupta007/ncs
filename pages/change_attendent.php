<?php
	$comp_no = $_POST['complain_no'];
	$status= $_POST['set_status'];


	require('../resources/connect.php');

	$update_query="UPDATE complain SET attendant='$status' WHERE complain_no='$comp_no'";

	if($result=mysqli_query($conn, $update_query))
	{
		echo "1";
	}
	else
	{
		echo "0";
	}

?>