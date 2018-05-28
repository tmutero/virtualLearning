<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Ehealth Diagnosis System</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/datepicker3.css" rel="stylesheet">
</head>
<body>
<body style="background-image: url('../assets/images/bodybg.gif'); ">


<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.php">
                    <h4></h4>
                </a>
            </div>
            <div class="login-form">
                <form method="post" action="create_user.php">
                    <center> <img src="../assets/images/app2.jpg" class="img-responsive" alt="logo" height="150px" width="200px"></center>
                    <?php echo display_error(); ?>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php echo $username; ?>">

                    </div>
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value=""></option>
                            <option value="admin">Admin</option>
                            <option value="provider">Provider</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password_1" >
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password_2" >
                    </div>


                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" name="register_btn">Register</button>
                    <div class="social-login-content">

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>