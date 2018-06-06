<?php
include('functions.php');
include('conn.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
$userId = $_SESSION['user']['id'];
$select = "SELECT * FROM student WHERE user_id=" . $userId;
$run_select = mysqli_query($conn, $select);
$row = mysqli_fetch_array($run_select);
$student_id = $row['id'];

$student_name = $row['firstname'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VL</title>
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
                    <li rel="presentation"><a href="#">Welcome ::<?php echo  $student_name;?></a> </li>

                </ul>
                <a href="index.php?logout='1"> <button class="btn btn-primary navbar-btn navbar-right" type="button">Logout </button></a>
               
            </div>
        </div>
    </nav>
    <ol class="breadcrumb">
        <li><a href="#"><span>Online Course</span></a></li>

        <li class="active"><span>Details </span></li>
    </ol>
    <div class="container">
        <div class="row">
<div class="col-md-2"></div>
            <div class="col-md-8">
                <h4>Available Online Videos</h4>

                    <?php
                    $getvideos = mysqli_query($conn, "SELECT t.title,t.date_created,t.description,c.name,t.id FROM topic t JOIN course c ON 
t.course_id=c.id JOIN registration r ON r.course_id=c.id where r.student_id='$student_id'");
                    $numrows = mysqli_num_rows($getvideos);

                    if ($numrows == 0) {
                        die("No upload video available.");
                    } else {
                    while ($row = mysqli_fetch_assoc($getvideos)) {
                    $title = $row['title'];

                    $date_created = $row['date_created'];
                    $desc = $row['description'];

                    $course = $row['name'];


                    ?>
                    <strong>Course name: <?php echo $course; ?></strong><br>
                    <strong style="font-family:'Courier New', Courier, monospace;">Title: <?php echo $title; ?></strong><br>

                    <strong style="font-family:'Courier New', Courier, monospace;">Description:<?php echo $desc; ?></strong><br>
                        <a href="online.php?&id=<?php echo $row['id'];?>">
                            <button type="button" class="btn btn-sm btn-info" >View
                            </button>
                        </a>
                    <hr>
                        <?php

                    }
                    }
                    ?>
                </div>




            <div class="col-md-2">

            </div>

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