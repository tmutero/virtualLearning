<?php
include('../functions.php');
include ('../conn.php');

if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$admin = $_SESSION['user']['username'];
$admin_id = $_SESSION['user']['id'];
$admin_email=$_SESSION['user']['email'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
    <link href="assets/css/material.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
</head>
<body><div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Admin ::<?php echo  $admin;?></a>
        </div>
        <!-- Top Menu Items -->

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                </li>
                <li>
                    <a href="provider.php"><i class="fa fa-fw fa-table"></i> Provider List</a>
                </li>
                <li>
                    <a href="sme.php"><i class="fa fa-fw fa-edit"></i> SME List</a>
                </li>
                <li>
                    <a href="bulksms.php"><i class="fa fa-fw fa-power-off"></i> Bulk Sms</a>
                </li>
                <li>
                    <a href="create_user.php"><i class="fa fa-fw fa-power-off"></i> Create User</a>
                </li>
                <li>
                    <a href="home.php?logout='1'""><i class="fa fa-fw fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        Bulk SMS
                    </h3>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Page Heading end-->

            <!-- panel start -->

            <!-- panel end -->
            <div class="row">
                <div class="col-sm-3">
                    <h4>To enter multiple number, seperate the contacts by comma (,)</h4>

                </div>

                <div class="col-sm-6">
                    <?php
                    $sql ="SELECT  * from sme";
                    $sme_query=mysqli_query($conn,$sql) or die("error getting data");
                    while($row = mysqli_fetch_array($sme_query, MYSQL_ASSOC)){
                        $smePhones = $row['phoneNumber'];
                    }

                    
                    ?>
                    <div>
                        <div id="result"></div>
                        <form class="form-control">
                            <label>Phone Number</label>
                            <input type="number" id="phone" class="form-control" >
                            <label>Message</label>
                            <textarea id="message" class="form-control"></textarea><br/>

                            <button type="button" class="btn btn-danger btn-sm" id="btn" onclick="sms()">Send Text</button>
                        </form>
                    </div>
                </div>


            </div>
            <script type="text/javascript">
                function chkit(uid, chk) {
                    chk = (chk==true ? "1" : "0");
                    var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
                    if(window.XMLHttpRequest) {
                        req = new XMLHttpRequest();
                    } else if(window.ActiveXObject) {
                        req = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    // Use get instead of post.
                    req.open("GET", url, true);
                    req.send(null);
                }
            </script>



        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->



<!-- jQuery -->
<script src="assets/js/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $(".delete").click(function(){
            var element = $(this);
            var appid = element.attr("id");
            var info = 'id=' + appid;
            if(confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    type: "POST",
                    url: "deleteappointment.php",
                    data: info,
                    success: function(){
                    }
                });
                $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
            }
            return false;
        });
    });

</script>
<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<!-- script for jquery datatable start-->

<script>
    function sms() {
        var btn =$("#btn").val();
        var phone=$("#phone").val();
        var message=$("#message").val();

        $.post("../smsText.php", {

                btn :btn ,
                phone:phone,
                message:message,


            },

            function(data) {
                $('#result').html(data);
                $('#su')[0].reset()

            });
    }

</script>
<script type="text/javascript">
    /*
    Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
    */
    $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9') return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });
    });
</script>


</body>
</html>