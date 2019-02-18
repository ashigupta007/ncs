<?php
    session_start();
    if(!isset($_SESSION['login_user']))
    {
        header('location:session_expired.html');
    }


    if(isset($_POST['add_employee']))
    {
        $emp_name=$_POST['emp_name'];
        $emp_email=$_POST['emp_email'];
        $emp_phn=$_POST['emp_phone'];
        $emp_id=rand(9999,999)+rand(9999,999)+rand(9999,999);

        require('../resources/connect.php');

        $add_emp_query="INSERT INTO emp(emp_id, emp_name, emp_email, emp_mobno) VALUES ('$emp_id', '$emp_name', '$emp_email', '$emp_phn')";

        if (!mysqli_query($conn, $add_emp_query)) 
        {
            echo "emp_not added";
        }
    }

    if(isset($_POST['remove_user']))
    {
        require('../resources/connect.php');

        $fetch_emp_id_query="SELECT emp_id FROM emp";

        if($emp=mysqli_query($conn, $fetch_emp_id_query))
            {
                while($emp_checkbox_name = mysqli_fetch_assoc($emp)) 
                {
                    $emp_xyz = $emp_checkbox_name['emp_id'];
                        if(array_key_exists($emp_xyz, $_POST))
                        {
                            if ($_POST[$emp_xyz] == "remove") 
                            {
                                $delete_emp_query="DELETE FROM emp WHERE emp_id = '$emp_xyz'";
                                mysqli_query($conn, $delete_emp_query);
                            }
                        }
                }

            }



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
            <span class="logo">E</span>
            Add / Remove Employee
        </h1>

        <dic class="row controls">
            <div class="col-sm-6">
                <div class="cont table-responsive" style="margin-top: -10px;">
                    <h4>All Employee</h4>
                    <p>All the Employee In the company</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Employee Name</td>
                                <td>Employee Id</td>
                                <td>Employee Email</td>
                                <td>Employee Phone no.</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            
                            require('../resources/connect.php');

                            $fetch_emp_query="SELECT * FROM emp";

                            if($emp=mysqli_query($conn, $fetch_emp_query))
                            {
                                 while($row = mysqli_fetch_assoc($emp)) 
                                {
                                    echo "<tr>
                                    <td>".$row['emp_name']."</td>
                                    <td>".$row['emp_id']."</td>
                                    <td>".$row['emp_email']."</td>
                                    <td>".$row['emp_mobno']."</td>
                                    </tr>";

                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Add New Employee</h4>
                <form action="edit_employee.php" method="POST" onsubmit="return validate_emp_form()">
                    <input type="text" name="emp_name" class="txt-sml" placeholder="Employee Name" id="emp_name"><br>
                    <input type="text" name="emp_email" class="txt-sml" placeholder="Employee Email" id="emp_email"><br>
                    <input type="text" name="emp_phone" class="txt-sml" placeholder="Employee Phone No." id="emp_phn"><br>
                    
                    <br>

                    <button type="submit" class="btn-sml" name="add_employee">Add Employee</button>
                </form>
            </div>
        </div>
        


        <div class="cont table-responsive" style="">
            <h4>Remove User</h4>
            <p>Select Checkbox And Click Remove To Remove Employee</p>
                    <form action="edit_employee.php" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Select</td>
                                <td>Employee Name</td>
                                <td>Employee Id</td>
                                <td>Employee Email</td>
                                <td>Employee Phone no.</td>

                            </tr>
                        </thead>

                        <tbody>
                            
                            <?php
                            require('../resources/connect.php');

                            $fetch_emp_query="SELECT * FROM emp";

                            if($emp=mysqli_query($conn, $fetch_emp_query))
                            {
                             while($row = mysqli_fetch_assoc($emp)) 
                                {
                                    echo "<tr>
                                    <td><input type='checkbox' name='".$row['emp_id']."' value='remove'></td>
                                    <td>".$row['emp_name']."</td>
                                    <td>".$row['emp_id']."</td>
                                    <td>".$row['emp_email']."</td>
                                    <td>".$row['emp_mobno']."</td>
                                    </tr>";

                                }
                            }

                            ?>
                           
                        </tbody>
                    </table>

                    <button class="btn-sml" type="submit" name="remove_user">Remove User</button>
                    </form>
                </div>
    </div>
</body>
    <script type="text/javascript">
        function validate_emp_form()
        {
            if($('#emp_name').val().length==0)
            {
                alert('Please Enter A valid Name');
                return false;
            }
            else if ($('#emp_email').val().length==0)
            {
                alert('Please Enter A valid email');
                return false;
            }
            else if ($('#emp_phn').val().length==0)
            {
                alert('Please Enter A valid Phone Number');
                return false;
            }
            else if (isNaN($('#emp_phn').val()) == true)
            {
                alert('Please Enter A valid Phone Number');
                return false;
            }
            else
            {
                return true;
            }
        }
    </script>
</html>