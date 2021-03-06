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
                <img src="../images/logo2.png"> NCS
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
             <h1><font>Complain</font> Forum</h1>
             <p class="tag-line">
                 Got an issue? Let Us know.
             </p>
        </div>

        <div class="form-container">
            Got an issue with the current service or got stuck in some other issue? Please fill out the complain form to let us know about the issue. We will look into the problem and get back to you soon.

             <form action="complain_submitted.php" method="POST" onsubmit="return validate_form()">
                <input type="text" class="txt-sml" name="name" placeholder="Name*" id="name">
                <input type="text" class="txt-sml" name="company_name" placeholder="Company Name*" id="compname">
                <input type="email" class="txt-sml"  name="email" placeholder="E-mail*" id="email">
                <input type="text" class="txt-sml" name="mobno" placeholder="Mobile Number*" id="mobno">

                <textarea class="txt-lg" name="complain" placeholder="Describe Complain Here*" id="complain"></textarea>

                <p class="small">
                    Field marked with * are important
                </p>
                <button type="submit" name="submit" class="btn_lg dark" style="margin:20px;"><i class="far fa-envelope-open"></i>Submit</button>
             </form>
        </div>

        <div class="footer">
        &copy; National Computer Solutions.
    </div>
    </div>

</body>
    <script type="text/javascript">
        function validate_form()
        {
            if($('#name').val().length == 0)
            {
                alert("Please input a valid Name");
                return false;
            }
            else if($('#compname').val().length == 0)
            {
                alert("Please input Company Name");
                return false;
            }
            else if($('#email').val().length == 0)
            {
                alert("Please input a valid Email id");
                return false;
            }
            else if($('#mobno').val().length == 0)
            {
                alert("Please input a valid Mobile Number");
                return false;
            }
            else if($('#complain').val().length == 0)
            {
                alert("Please input your complain before submitting");
                return false;
            }
            else
            {
                return true;
            }

        }
    </script>

</html>