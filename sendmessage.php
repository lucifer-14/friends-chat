<?php 
include "utilities/helper.php";
include "utilities/config.php";

$senderId=$_GET['senderId'];
$receiverId=$_GET['receiverId'];
$groupId=$_GET['groupId'];
$message=mysqli_real_escape_string($conn, $_POST['message']);
$combinedId=null;
if($groupId==0)
	$combinedId = ($senderId<$receiverId)? ($senderId." ".$receiverId) : ($receiverId." ".$senderId);

$messagecheck=true;
$msgsplit=str_split($message,1);
for($i=0;$i<strlen($message);$i++)
{
	if($msgsplit[$i]!=" "){
		$messagecheck=false;
	}
}

if(isset($message) && $messagecheck==false){
$query = "insert into messages(senderId, receiverId, groupId, message, sentDate, combinedId) values('$senderId', '$receiverId', '$groupId', '$message', now(), '$combinedId')";
mysqli_query($conn, $query);
}

if($groupId==0)
	header("location:friendschatcommon.php?friendId=$receiverId");
if($receiverId==0)
	header("location:groupschatcommon.php?groupId=$groupId");
