<?php
    session_start();
    if(isset($_SESSION['login_user']))
    {
        header('location:dashboard_home.php');
    }

    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];

        require('../resources/connect.php');

        if (!$conn)
        {
            die("Connection failed: " . mysqli_connect_error());
        }
        $login_query="SELECT * FROM login WHERE email='$email'";

        $result=mysqli_query($conn, $login_query);
        $count= mysqli_num_rows($result);

        echo $email . $pass .'<br>';
        if($count == 1)
        {   
            session_start();
            $_SESSION['login_user'] = $email;
            header('location:dashboard_home.php');
        }
        else
        {
            echo $count;
          die("Connection failed here:");
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

    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
</head>
<body>
    <nav class="custom-navbar">
        <div class="navbar-container">
            <div class="header">
                <img src="../images/logo2.png"> Dashboard
            </div>
            
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-small"><i class="fas fa-bars"></i></button>

            <div class="menu right">
                <ul class="large-menu">
                    <li><a href="../index.html"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="../index.html#about"><i class="far fa-id-card"></i> About Us</a></li>
                    <li><a href="../index.html#clients"><i class="fas fa-briefcase"></i> Services</a></li>
                    <li><a href="../index.html#contact"><i class="far fa-envelope"></i> Contact</a></li>
                    <li><a href="dashboard_login.html"><i class="far fa-chart-bar"></i> Dashboard</a></li>
                </ul>
            </div>

            <div class="collapse navbar-small" id="navbar-small">
                <ul class="small-menu">
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#about"><i class="far fa-id-card"></i> About Us</a></li>
                    <li><a href="#clients"><i class="fas fa-briefcase"></i> Services</a></li>
                    <li><a href="#contact"><i class="far fa-envelope"></i> Contact</a></li>
                    <li><a href="#"><i class="far fa-chart-bar"></i> Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="custom-container-2">
        <div class="header-half">
             <h1><font>Dashboard</font> Panel</h1>
             <p class="tag-line">
                 Manage Everything From Here
             </p>
        </div>

        <div class="form-container-2">
            <h1>
                Login To Dashboard
            </h1>

            <form method="POST" action="dashboard_login.php">
                <input type="text" name="email" class="txt-sml" placeholder="User name">

                <input type="password" name="pass" class="txt-sml" placeholder="Password">

                <button type="submit" name="login" class="btn_lg dark" style="display: block;">
                    Login
                </button>
            </form>
        </div>

        <div class="footer">
        &copy; National Computer Solutions.
    </div>
    </div>



</body>
</html>