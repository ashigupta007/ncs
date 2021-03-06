<?php
    session_start();
    if(!isset($_SESSION['login_user']))
    {
        header('location:dashboard_login.php');
    }
    if(isset($_GET['logout']))
    {
        session_destroy();
        header('location:../index.html');
    }
?>
<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, minimum-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

    <link rel="stylesheet" type="text/css" href="../css/animate.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
</head>
<body>
    <nav class="custom-navbar-top">
        <div class="nav-cont">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-small"><i class="fas fa-bars"></i></button>
            <div class="menu right">
                <ul class="large-menu">
                    <li><a href="../index.html"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="../index.html#about"><i class="far fa-id-card"></i> About Us</a></li>
                    <li><a href="../index.html#clients"><i class="fas fa-briefcase"></i> Services</a></li>
                    <li><a href="../index.html#contact"><i class="far fa-envelope"></i> Contact</a></li>
                    <li><a href="dashboard_home.php?logout"><i class="far fa-chart-bar"></i> Logout</a></li>
                </ul>
            </div>

            <div class="collapse navbar-small" id="navbar-small">
                <ul class="small-menu">
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#about"><i class="far fa-id-card"></i> About Us</a></li>
                    <li><a href="#clients"><i class="fas fa-briefcase"></i> Services</a></li>
                    <li><a href="#contact"><i class="far fa-envelope"></i> Contact</a></li>
                    <li><a href="dashboard_home.php?logout"><i class="far fa-chart-bar"></i> Logout</a></li>
                </ul>
            </div>

        </div>
    </nav>




    <nav class="custom-navbar-left" is_open="1">
        <!-- ************************************************ -->

        <button class="toggle_btn" id="toggle_btn"><i class="fas fa-angle-left"></i></button>

        <div class="header">
            <div class="icon">
                <img src="../images/logo2.png">
            </div> 

            <div class="text">
                NCS
            </div>
        </div>
        <!-- ************************************************ -->


        <div class="menu-left">
            <div class="menu-holder">
            <!-- ************************************************ -->
                <a href="complain_details.php" target="frame" class="item">
                    <div>
                        <div class="icon"><i class="fas fa-tasks"></i></div>
                        <div class="text">Complain Details</div>
                    </div>
                </a>
            <!-- ************************************************ -->
            <!-- ************************************************ -->
               <!--  <a href="#" target="frame" class="item">
                    <div>
                        <div class="icon"><i class="fas fa-pencil-ruler"></i></div>
                        <div class="text">Assign Attendant</div>
                    </div>
                </a> -->

               <!--  <div class="collapse">
                    <div class="collapsed_menu">
                        <li><a href="#" id="update_nx_option_file">Update NX_Option File</a></li>
                        <li><a href="#" id="edit_trainee">View / Edit Trainee Users</a></li>
                        <li><a href="#" id="all_user">View All Users</a></li>
                        <li><a href="#" id="view_file">View NX Option File</a></li>
                        <li><a href="#">Statistic</a></li>
                    </div>
                </div> -->
            <!-- ************************************************ -->
            <!-- ************************************************ -->
            <a href="edit_employee.php" target="frame" class="item">
                <div>
                    <div class="icon"><i class="fas fa-user-plus"></i></div>
                    <div class="text">Add/Remove Employee</div>
                </div>
            </a>

            <!-- ************************************************ -->
            <!-- ************************************************ -->
            <a href="sales.php" target="frame" class="item">
                <div>
                    <div class="icon"><i class="fas fa-chart-pie"></i></div>
                    <div class="text">Get Sales Details</div>
                </div>
            </a>

            <!-- ************************************************ -->
            </div>
        </div>
    </nav>

    <div id="main-view">
        <iframe src="defaultpage.html" id="frame" frameBorder="0" name="frame"></iframe>
    </div>




</body>


<script type="text/javascript">
    $('.dropdown-toggle').dropdown();
        $('.text').show();
        var width_initial= $(window).width()-90;
        $('#main-view').css("width" , width_initial);
        var nav_status=$('.custom-navbar-left').attr('is_open');
        var first_click=0;

        $('#toggle_btn').click(function(){
            if(nav_status == 0)
            {
                $('.text').show(50);
                nav_status = 1;
                $('#toggle_btn').children("i").toggleClass("fa-angle-right", 0);
                $('#toggle_btn').children("i").toggleClass("fa-angle-left",150);
            }
            else
            {
                $('.text').hide(50);
                nav_status = 0;
                $('#toggle_btn').children("i").toggleClass("fa-angle-right", 0);
                $('#toggle_btn').children("i").toggleClass("fa-angle-left",150);
                $('.collapse').collapse("hide");
                
            }
        });
        
        var frame_height = $('#main-view').height()-3;
        var frame_width=$(document).width() - 92;

        $('#frame').attr("height", frame_height);
        $('#frame').attr("width", frame_width);



        $('.item').click(function(){
            if(nav_status==1)
            {
                $('#toggle_btn').click();
            }
            
        });

        $('.activate-collapse').click(function(){
            if (nav_status==0) 
            {
                $('#toggle_btn').click();
                $('.collapse').collapse('hide');
                $(this).next('.collapse').slice(0).collapse('toggle');
            }
            else
            {
                $('.collapse').collapse('hide');
                $(this).next('.collapse').slice(0).collapse('toggle');
            }
        });

        $('.collapsed_menu li').click(function(){
            $('.collapse').collapse('hide');
            $('#toggle_btn').click();
        })

        $( window ).resize(function() {
            var width_initial= $(window).width()-92;
            $('#main-view').width(width_initial);
            var frame_height = $('#main-view').height() - 3;
            var frame_width=$('#main-view').width() ;
            $('#frame').attr("height", frame_height);
            $('#frame').attr("width", frame_width);
        });
</script>
</html>