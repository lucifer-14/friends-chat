<?php
include "utilities/helper.php";
include "utilities/config.php";

$userId = $_GET['userId'];
$query = "delete from friendslist where (f_userId=$currentUser or f_userId=$userId) and (s_userId=$currentUser or s_userId=$userId)";
mysqli_query($conn, $query);
$query2 = mysqli_query($conn, "select * from users where id=$userId");
$queryE = mysqli_fetch_object($query2);
$name = $queryE->username;
header("location: addfriends.php?search=$name")
?>