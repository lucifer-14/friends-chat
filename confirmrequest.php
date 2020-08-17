<?php
include "utilities/config.php";
include "utilities/helper.php";

$friendrequestId=$_GET['friendrequestId'];
$query = "update friendslist set active=1 where id=$friendrequestId";
mysqli_query($conn, $query);
if(isset($_GET['userId'])){
	$userId = $_GET['userId'];
	$query2 = mysqli_query($conn, "select * from users where id=$userId");
	$queryE = mysqli_fetch_object($query2);
	$name = $queryE->username;
	header("location: addfriends.php?search=$name");
}else{
	header("location: friendrequests.php");
}

?>