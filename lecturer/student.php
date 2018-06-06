<?php
include('../functions.php');
include ('../conn.php');

if (!isLecturer()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$user = $_SESSION['user']['username'];
$lecturer_id = $_SESSION['user']['id'];
$sql ="select * from lecturer where user_id='$lecturer_id'";
$result =mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$id=$row['id'];

$sql ="select * from lecturer_courses where lecturer_id='$id'";
$result =mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
$course_id=$row['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lecturer</title>

    <link href="assets/css/material.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Lecturer <?php echo $user;?></a>
        </div>
        <!-- Top Menu Items -->


        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>

                <li>
                    <a href="topic.php"><i class="fa fa-fw fa-group"></i>Topic Discussions</a>
                </li>

                <li>
                    <a href="online.php"><i class="fa fa-fw fa-book"></i>Online Materials</a>
                </li>


                <li>
                    <a href="student.php"><i class="fa fa-fw fa-user"></i>Registered Students</a>
                </li>


                <li>
                    <a href="home.php?logout='1'""><i class="fa fa-fw fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- navigation end -->

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">
                        Dashboard
                    </h4>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-file"></i> Students
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Page Heading end-->

            <!-- panel start -->
            <div class="panel panel-primary filterable">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">Registered Students </h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button>
                    </div>
                </div>
                <div class="panel-body">
                    <!-- Table -->
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder=" Firstname" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Surname" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Reg Number" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Course Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Course Code" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Level" disabled></th>


                        </tr>
                        </thead>

                        <?php
                        $sql = "SELECT * FROM registration r JOIN student s ON r.student_id = s.id JOIN course c ON r.course_id=c.id  WHERE r.course_id='$course_id'";
                        $res = mysqli_query($conn, $sql);
                        if (!$res) {
                            printf("Error: %s\n", mysqli_error($conn));
                            exit();
                        }
                        while ($course = mysqli_fetch_array($res)) {

                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $course['firstname'] . "</td>";
                            echo "<td>" . $course['surname'] . "</td>";
                            echo "<td>" . $course['regNumber'] . "</td>";
                            echo "<td>" . $course['name'] . "</td>";
                            echo "<td>" . $course['code'] . "</td>";
                            echo "<td>" . $course['level'] . "</td>";



                            echo "</td>";

                        }

                        ?>
                </div>
            </div>
            <!-- panel end -->


            <!-- jQuery -->
            <script src="assets/js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="assets/js/bootstrap.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <!-- script for jquery datatable start-->



</body>
</html>