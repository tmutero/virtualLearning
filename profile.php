<?php
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


$select = "SELECT * FROM student WHERE user_id=" . $userId;
$run_select = mysqli_query($conn, $select);
$rows = mysqli_fetch_array($run_select);
$student_id = $rows['id'];

$student_name = $rows['firstname'];


if (isset($_POST['submit'])) {
//variables
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];


    $sql="UPDATE student SET firstname='$firstname', surname='$surname', phoneNumber='$phoneNumber', 
 gender='$gender', email='$email', dob='$dob' WHERE user_id='$userId'";
    $res=mysqli_query($conn,$sql);


    header( 'Location: profile.php' ) ;
}



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
            <a href="index.php?logout='1"""> <button class="btn btn-primary navbar-btn navbar-right" type="button">Logout </button></a>

        </div>
    </div>
</nav>

<ol class="breadcrumb">
    <li><a href="#"><span>Student</span></a></li>

    <li class="active"><span>Details </span></li>
</ol>

<div class="container">
    <div class="row">

        <div class="col-md-3 col-sm-3">
            <div class="user-wrapper">
                <img src="assets/images/icon.png" width="100" height="100" class="img-responsive" />
                <div class="description">
                    <h4><?php echo $row['firstname']; ?> <?php echo $row['surname']; ?></h4>
                    <h5> <strong> Student Details </strong></h5>
                    <p>

                    </p>
                    <hr />
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
                </div>
            </div>

        </div>
        <div class="col-sm-9">


            <div class="description">
                <h3> <b>Student </b> <?php echo $row['firstname']; ?> </h3>
                <hr />

                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-user-information" align="center">
                            <tbody>
                            <tr>
                                <td>Registration Number</td>
                                <td><?php echo $row['regNumber']; ?></td>
                            </tr>

                            <tr>
                                <td>Firstname</td>
                                <td><?php echo $row['firstname']; ?></td>
                            </tr>
                            <tr>
                                <td>Surname</td>
                                <td><?php echo $row['surname']; ?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><?php echo $row['gender']; ?></td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td><?php echo $row['dob']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><?php echo $row['phoneNumber']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td><?php echo $row['email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Degree Name</td>
                                <td><?php echo $row['name']; ?>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
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
    <div class="col-md-4">

        <!-- Large modal -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Profile Detail</h4>
                    </div>
                    <div class="modal-body">
                        <!-- form start -->
                        <form action="<?php $_PHP_SELF ?>" method="post" >
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Registration Number</td>
                                    <td><?php echo $row['regNumber']; ?></td>
                                </tr>
                                <tr>
                                    <td>Firstname</td>
                                    <td><input type="text" class="form-control" name="firstname" required value="<?php echo $row['firstname']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Surname:</td>
                                    <td><input type="text" class="form-control" name="surname" required value="<?php echo  $row['surname']; ?>"  /></td>
                                </tr>

                                <tr>
                                    <td>Gender</td>

                                    <td>
                                        <div class="radio" required>
                                            <label><input type="radio" name="gender" value="M">Male</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="gender" value="F" >Female</label>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Date of Birth</td>
                                    <td><input type="date" class="form-control" name="dob" required value="<?php echo $row['dob']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Phone Number </td>
                                    <td><input type="text" class="form-control" name="phoneNumber" required value="<?php echo $row['phoneNumber']; ?>"  /></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" class="form-control" name="email"  required value="<?php echo $row['email']; ?>"  /></td>
                                </tr>

                                <!-- radio button end -->

                                <tr>
                                    <td>
                                        <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
                                </tr>

                                </tbody>

                            </table>



                        </form>
                        <!-- form end -->
                    </div>

                </div>
            </div>
        </div>
        <br /><br/>
    </div>
<script src="assets1/js/jquery.min.js"></script>
<script src="assets1/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>