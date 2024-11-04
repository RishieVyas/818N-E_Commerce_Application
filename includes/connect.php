<?php 
// $con=mysqli_connect('localhost','root','','ecommerce_1');
$con = new mysqli('database-2.c3uicks2o9tx.us-east-1.rds.amazonaws.com','group5_admin','Group5#Admin','ecommerce_1');
if(!$con){
    die(mysqli_error($con));
}




?>