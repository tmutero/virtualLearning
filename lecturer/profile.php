<?php
include('../functions.php');
include ('../conn.php');
if (!isProvider()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$user = $_SESSION['user']['username'];
$user_id=$_SESSION['user']['id'];
$select = "SELECT * FROM provider WHERE user_id=" . $user_id;
$run_select = mysqli_query($conn, $select);
$row = mysqli_fetch_array($run_select);
$companyName = $row['companyName'];


if (isset($_POST['submit'])) {
//variables
    $companyName = $_POST['companyName'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $businessType = $_POST['businessType'];
    $email = $_POST['email'];


    $sql="UPDATE provider SET companyName='$companyName', phoneNumber='$phoneNumber', businessType='$businessType',
 address='$address', email='$email' WHERE user_id='$user_id'";
    $res=mysqli_query($conn,$sql);


    header( 'Location: profile.php' ) ;
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
    <title>Loan Provider</title>

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
            <a class="navbar-brand" href="home.php">Loan Provider <?php echo $user;?></a>
        </div>
        <!-- Top Menu Items -->


        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="applicants.php"><i class="fa fa-fw fa-user"></i>Applications</a>
                </li>
                <li>
                    <a href="loan.php"><i class="fa fa-fw fa-table"></i> Loans</a>
                </li>
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-user"></i>Profile</a>
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
                        Loan
                    </h4>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-file"></i> Profile
                        </li>
                    </ol>
                </div>
            </div>
            <div class="panel panel-primary">

                <!-- panel heading starat -->
                <div class="panel-heading">
                    <h3 class="panel-title">Doctor Details</h3>
                </div>
                <!-- panel heading end -->

                <div class="panel-body">
                    <!-- panel content start -->
                    <div class="container">
                        <section style="padding-bottom: 50px; padding-top: 50px;">
                            <div class="row">
                                <!-- start -->
                                <!-- USER PROFILE ROW STARTS-->
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="user-wrapper">
                                            <center><img src="assets/img/icon.png"  height="90" width="90" class="img-responsive" /></center>

                                            <div class="description">
                                                <h4><?php echo $companyName; ?> <?php echo $companyName; ?></h4>
                                                <h5> <strong> Provider </strong></h5>

                                                <hr />
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9 ">
                                        <div class="description">
                                            <h3> <?php echo $companyName; ?>  </h3>
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
                                                            <td>Phone Number</td>
                                                            <td><?php echo $row['phoneNumber']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td><?php echo $row['address']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Busines Type</td>
                                                            <td><?php echo $row['businessType']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><?php echo $row['email']; ?>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- USER PROFILE ROW END-->
                                <div class="col-md-4">

                                    <!-- Large modal -->

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Profile </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form start -->
                                                    <form action="<?php $_PHP_SELF ?>" method="post" >
                                                        <table class="table table-user-information">
                                                            <tbody>
                                                            <tr>
                                                                <td>Registration Number:</td>
                                                                <td><?php echo $row['regNumber']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Company Name:</td>
                                                                <td><input type="text" class="form-control" name="companyName" value="<?php echo $row['companyName']; ?>"  /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone Number</td>
                                                                <td><input type="text" class="form-control" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>"  /></td>
                                                            </tr>


                                                            <tr>
                                                                <td>Address</td>
                                                                <td><input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>"  /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>"  /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Business Type</td>

                                                                <td>
                                                                    <div class="radio">
                                                                        <label><input type="radio" name="businessType" value="Private">Private Sector</label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label><input type="radio" name="businessType" value="Public" >Public Sector</label>
                                                                    </div>

                                                                </td>
                                                            </tr>
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

                            </div>
                            <!-- panel content end -->
                            <!-- panel end -->
                        </section>
                    </div>
                </div>
                <!-- panel start -->

            </div>
            <!-- Page Heading end-->

            <!-- panel start -->

            <!-- panel end -->


            <!-- jQuery -->
            <!-- Bootstrap Core JavaScript -->
            <script src="assets/js/bootstrap.min.js"></script>
            <!-- Latest compiled and minified JavaScript -->
            <!-- script for jquery datatable start-->
            <script src="assets/js/jquery.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>


</body>
</html>