<?php
session_start();
$dbhost = "us-cdbr-east-02.cleardb.com";
$user = "b9e2b39d4e1466";
$pass = "47a29977";
$dbname = "heroku_78d3bf322bd68ea";
$conn = mysqli_connect($dbhost, $user, $pass);
mysqli_select_db($conn, $dbname);
$imagePath = "user_img/";
$title = 'Home';
$currentUser = $_SESSION['userId'] ?? '';
$pageno = 1;
$limit = 10;
$limit_u = 9;
