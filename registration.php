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
$username = $_SESSION['user']['username'];
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
    <title>VL-Course</title>
    <link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets1/css/user.css">
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">VL System</a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span
                        class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav">
                <li role="presentation"><a href="index.php">Dashbord </a></li>
                <li role="presentation"><a href="registration.php">Registration </a></li>
                <li role="presentation"><a href="profile.php">Profile </a></li>
                <li rel="presentation"><a href="#">Welcome ::<?php echo  $student_name;?></a> </li>


            </ul>
            <a href="index.php?logout='1">
                <button class="btn btn-primary navbar-btn navbar-right" type="button">Logout</button>
            </a>

        </div>
    </div>
</nav>
<ol class="breadcrumb">
    <li><a href="#"><span>Registration</span></a></li>

    <li class="active"><span>Details </span></li>
</ol>

<div class="container">
    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">
            <?php
            include('conn.php');
            $select = "SELECT * FROM registration WHERE student_id='$student_id'";
            $run_select = mysqli_query($conn,$select);
            $registraton = mysqli_fetch_array($run_select);
            $num_row = mysqli_num_rows($run_select);


            if ($num_row ==0) {
                echo "<div class='alert alert-danger alert-dismissable'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo " <i class='fa fa-info-circle'></i>  <strong>No registered Course found.";
                echo "  </div>";

            ?>
                <div class="panel panel-primary filterable">

                    <div class="panel-heading">
                        <h3 class="panel-title">Courses</h3>

                    </div>
                    <div class="panel-body">
                        <!-- Table -->
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="Course Name" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Course Code" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Level" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Status" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Action" disabled></th>

                            </tr>
                            </thead>

                            <?php
                            $sql = "SELECT * FROM course";
                            $res = mysqli_query($conn, $sql);
                            if (!$res) {
                                printf("Error: %s\n", mysqli_error($conn));
                                exit();
                            }
                            while ($course = mysqli_fetch_array($res)) {

                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . $course['name'] . "</td>";
                                echo "<td>" . $course['code'] . "</td>";
                                echo "<td>" . $course['level'] . "</td>";

                                echo "<td>" . '<span class="label label-info">Not Registered</span>' . "</td>";

                                echo "<form method='POST'>";
                                echo "<td class='text-center'><a href='#' id='" . $course['id'] . "' class='aprove'><span class='glyphicon glyphicon-user' aria-hidden='true'>Approve</span></a>";

                                echo "</td>";


                            }

                            ?>
                             <input type="hidden" id="student_id" value="<?php echo  $student_id;?>">
                    </div>
                </div>

                <?php
            } else {


            ?>


            <table class="table table-striped table-bordered">
                <tr>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Level</th>
                    <th>Registration Date</th>
                </tr>


                <?php

                include('conn.php');
                $select = "SELECT * FROM registration r JOIN course c ON r.course_id=c.id WHERE r.student_id='$student_id'";
                $run_select = mysqli_query($conn, $select);

                while ($rows = mysqli_fetch_array($run_select)) {
                    $name = $rows['name'];
                    $date_created = $rows['date_created'];
                    $code = $rows['code'];
                    $level = $rows['level'];

                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $code; ?></td>
                        <td><?php echo $level; ?></td>
                        <td><?php echo $date_created; ?></td>

                    </tr>
                    <?php
                }

                ?>
                ?>

            </table>
        </div>


        <?php


        }
        ?>
        <div class="col-md-1"></div>






    </div>
</div>
<script src="assets1/js/jquery.min.js"></script>
<script src="assets1/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(function () {
        $(".aprove").click(function () {

            var element = $(this);
            var appid = element.attr("id");
            var info = appid;
            var student_id=$("#student_id").val();



            if (confirm("Are you sure you want to register this?")) {
                $.ajax({
                    type: "POST",
                    url: "register_course.php",
                    data: {info: info,
                    student_id:student_id},
                    success: function () {
                    }
                });
                $(this).parent().parent().fadeOut(300, function () {
                    $(this).remove();
                });
            }
            return false;
        });
    });
</script>
</body>

</html>




