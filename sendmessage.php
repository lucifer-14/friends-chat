<?php 
include "utilities/helper.php";
include "utilities/config.php";

$senderId=$_GET['senderId'];
$receiverId=$_GET['receiverId'];
$groupId=$_GET['groupId'];
$message=$_POST['message'];

$query = "insert into messages(senderId, receiverId, groupId, message, sentDate) values('$senderId', '$receiverId', '$groupId', '$message', now())";
mysqli_query($conn, $query);

if($groupId==0)
	header("location:friendschat.php?friendId=$receiverId");
if($receiverId==0)
	header("location:groupschat.php?groupId=$groupId");
