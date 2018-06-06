<?php
/**
 * Created by PhpStorm.
 * User: tmutero
 * Date: 6/4/2018
 * Time: 11:18 AM
 */
include('conn.php');


$course_id=$_POST['info'];
$student_id=$_POST['student_id'];

$insert = "INSERT INTO `registration`( `course_id`, `student_id`) VALUES ($course_id,$student_id)";
$run_insert = mysqli_query($conn, $insert);



?>