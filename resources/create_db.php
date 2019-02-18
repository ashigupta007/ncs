<?php
	require('connect.php');

	$create_db="CREATE DATABASE ncs";

	$create_table_complain="CREATE TABLE IF NOT EXISTS complain (complain_no INT(8) PRIMARY KEY, name VARCHAR(25), email VARCHAR(30), mobno VARCHAR(12), company_name VARCHAR(30), comp_details VARCHAR(500), attendant VARCHAR(30), status VARCHAR(10),time_of_submit VARCHAR(10), date_submitted(20))";

	$create_table_emp="CREATE TABLE IF NOT EXISTS emp (emp_id INT(8) PRIMARY KEY, emp_name VARCHAR(30) , emp_email  VARCHAR(30), emp_mobno VARCHAR(12 ))";

	$create_table_login="CREATE TABLE IF NOT EXISTS login(email(30) PRIMARY KEY, pass(30))";

	if(mysqli_query($conn, $create_db))
	{
		mysqli_query($conn, $create_table_complain);
		mysqli_query($conn, $create_table_login);
		mysqli_query($conn, $create_table_login);		
		echo "DB created SUCESSFULY";
	}
	else
	{
		echo "DB & Tables not created sucessfuly";
	}

	mysql_close();
?>