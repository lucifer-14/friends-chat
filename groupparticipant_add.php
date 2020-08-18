<?php 
include "utilities/config.php";
include "utilities/helper.php";

$groupId = $_GET['groupId'];
$groupmembersId = $_POST['id'];

$query = "update groupmembers set approved=1 where id=$groupmembersId";
mysqli_query($conn, $query);
header("location: groupschatcommon.php?groupId=$groupId");