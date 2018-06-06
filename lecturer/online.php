<?php
include('../functions.php');
include('../conn.php');

if (!isLecturer()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$user = $_SESSION['user']['username'];
$user_id = $_SESSION['user']['id'];
$sql = "select * from lecturer where user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$lecturer_id = $row['id'];

$sql = "select * from lecturer_courses where lecturer_id='$lecturer_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$course_id = $row['id'];


if (isset($_FILES['video'])) {

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $course_id = $_POST['course_id'];

    if (!empty($title) || ($desc) || ($course_id)) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $video_id = substr(str_shuffle($chars), 0, 15);
        $video_id = md5($video_id);


    } else {
        die('empty fields');
    }
    if (($_FILES['video']['type'] == 'video/mp4')) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $random_directory = substr(str_shuffle($chars), 0, 15);
        move_uploaded_file($_FILES['video']['tmp_name'], 'C:/xampp/htdocs/virtualLearning/uploads/' . $random_directory . '' . $_FILES['video']['name']);
        $img_name = $_FILES['video']['name'];
        $filename = "C:/xampp/htdocs/virtualLearning/uploads/" . $random_directory . $_FILES['video']['name'];

        $insert = mysqli_query($conn, "INSERT INTO `topic`( `course_id`, `title`, `location`, `lecturer_id`, `description`, `video_id`) 
VALUES ('$course_id','$title','$filename','$lecturer_id','$desc','$video_id')");


        die('The video was uploaded successfully');


    }
    echo "Errorr pliz";

}

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
            <a class="navbar-brand" href="home.php">Lecturer <?php echo $user; ?></a>
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
                    <a href="home.php?logout='1'"><i class="fa fa-fw fa-power-off"></i> Logout</a>
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
                            <i class="fa fa-file"></i> Online Materials
                        </li>
                    </ol>

                </div>
            </div>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload Video
            </button>
            <div class="panel panel-primary filterable">
                <!-- Default panel contents -->


                <div class="panel-heading">
                    <h3 class="panel-title">Online Materials </h3>
                    <div class="pull-right">

                    </div>
                </div>
                <div class="panel-body">


                    <?php
                    $getvideos = mysqli_query($conn, "SELECT * FROM topic t JOIN course c 
                    ON t.course_id=c.id WHERE lecturer_id='$lecturer_id'");
                    $numrows = mysqli_num_rows($getvideos);

                    if ($numrows == 0) {
                        die("You haven't uploaded a video yet.");
                    } else {
                    while ($row = mysqli_fetch_assoc($getvideos)) {
                    $title = $row['title'];
                    $thumbnail = $row['thumbnail'];
                    $id = $row['id'];
                    $date_created = $row['date_created'];
                    $desc = $row['description'];
                    $location = $row['location'];
                    $course = $row['name'];

                    $pat = "uploads/";
                    $pat1 = "C:/xampp/htdocs/virtualLearning/uploads/";

                    $vid = $pat1 . $location


                    ?>
                    <strong style="font-family:'Courier New', Courier, monospace;">Course
                        name: <?php echo $course; ?></strong><br>
                    <strong>Title: <?php echo $title; ?></strong>



                    <video width="320" height="240" controls>
                        <source src="C:/xampp/htdocs/virtualLearning/uploads/booyer.mp4" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                    <div>

                        <a href="#">
                            <button class="btn btn-sm btn-info"><span
                                        class="glyphicon glyphicon-zoom-in"></span>View Video
                            </button>
                        </a>
                    </div>

                </div>
                <strong style="font-family:'Courier New', Courier, monospace;">Description:<?php echo $desc; ?></strong>
                <hr>
            </div>


            <?php
            }
            }
            ?>


        </div>
    </div>


</div>


<script src="assets/js/jquery.js"></script>

<div class="col-md-4">

    <!-- Large modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="myModalLabel">Online Material</h5>
                </div>
                <div class="modal-body">
                    <!-- form start -->
                    <form action="<?php $_PHP_SELF ?>" method="post" enctype='multipart/form-data'>
                        <table class="table table-user-information">
                            <tbody>

                            <tr>
                                <td>Video Title:</td>
                                <td><input type="text" class="form-control" name="title" required/></td>
                            </tr>
                            <tr>
                                <td>Course Name:</td>
                                <td><select class="form-control" name="course_id">
                                        <?php

                                        $select = "SELECT  c.id, c.name FROM lecturer_courses lc JOIN course c ON lc.course_id=c.id
                                        WHERE lecturer_id='$lecturer_id'";
                                        $run_select = mysqli_query($conn, $select);

                                        while ($rows = mysqli_fetch_array($run_select)) {
                                            $id = $rows['id'];
                                            $course = $rows['name'];
                                            //var_dump($id);die();


                                            ?>

                                            <option value=<?php echo $id; ?>> <?php echo $course; ?>


                                            </option>
                                            <?php
                                        }

                                        ?>

                                    </select></td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td><textarea rows='5' cols='30' name='description' maxLength="200"
                                              required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>File:</td>
                                <td><input type='file' name='video' class="form-control file" required>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" name="submit" class="btn btn-info" value="Upload Video &uarr;">
                                </td>
                            </tr>
                            </tbody>

                        </table>


                    </form>
                    <!-- form end -->
                </div>

            </div>
        </div>
    </div>
</div>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- script for jquery datatable start-->

<script src="assets/js/bootstrap-clockpicker.js"></script>
</body>
</html>