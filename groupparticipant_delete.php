<?php 
include "utilities/config.php";
include "utilities/helper.php";

$groupId = $_GET['groupId'];
$groupmembersId = $_POST['id'];

$query = "delete from groupmembers where id='$groupmembersId'";
mysqli_query($conn, $query);
header("location: groupschatcommon.php?groupId=$groupId");