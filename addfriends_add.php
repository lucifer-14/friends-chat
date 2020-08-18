<?php
include "utilities/helper.php";
include "utilities/config.php";


$userId=$_GET['userId'];

$query = "insert into friendslist(f_userId, s_userId, active) values('$currentUser', '$userId', 0)";
mysqli_query($conn, $query);

$query2 = mysqli_query($conn, "select * from users where id=$userId");
$queryE = mysqli_fetch_object($query2);
$name = $queryE->username;
header("location:addfriends.php?search=$name");
?>