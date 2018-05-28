<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 5/27/2018
 * Time: 5:24 PM
 */


include('functions.php');
include('conn.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$username=$_SESSION['user']['username'];
$userId=$_SESSION['user']['id'];
$select="select * from student JOIN degree ON student.degree_id=degree.id where user_id=".$userId;
$run_select=mysqli_query($conn,$select);
$row=mysqli_fetch_array($run_select);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VL-Course</title>
    <link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets1/css/user.css">
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">VL System</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav">
                <li role="presentation"><a href="index.php">Dashbord </a></li>
                <li role="presentation"><a href="registration.php">Registration </a></li>
                <li role="presentation"><a href="profile.php">Profile </a></li>
                <li role="presentation"><a href="#">Online Virtual</a></li>
            </ul>
            <a href="index.php?logout='1"""> <button class="btn btn-primary navbar-btn navbar-right" type="button">Logout </button></a>

        </div>
    </div>
</nav>
<ol class="breadcrumb">
    <li><a href="#"><span>Registration</span></a></li>

    <li class="active"><span>Details </span></li>
</ol>

<div class="container">
    <div class="row">
        <?php
        include('conn.php');
        $select="select * from registration where student_id=".$userId;
        $run_select=mysqli_query($conn,$select);
        $registraton=mysqli_fetch_array($run_select);
        $num_row=mysqli_num_rows($run_select);

        if ($num_row == 0) {


            echo "<div class='alert alert-danger alert-dismissable'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo " <i class='fa fa-info-circle'></i>  <strong>No registered Course found.";
            echo "  </div>";


        } else {



        }
        ?>




    </div>
</div>
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>Virtual Learning© 2018</h5></div>
            <div class="col-sm-6 social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
        </div>
    </div>
</footer>
<script src="assets1/js/jquery.min.js"></script>
<script src="assets1/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>




