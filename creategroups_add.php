<?php
include "utilities/config.php";
include "utilities/helper.php";

$groupname = $_POST['groupname'];
$groupphoto = '';
if (!$_POST['groupPhoto_cropped'] == "") {
    $groupphoto = $_POST['groupPhoto_cropped'];
}

$query = "insert into groups (name, photo, active, createdDate) values('$groupname', '$groupphoto', 1, now())";
mysqli_query($conn, $query);
$queryF = mysqli_query($conn, "select * from groups where name='$groupname' order by createdDate desc limit 1");
$queryE = mysqli_fetch_object($queryF);
$groupId = $queryE->id;
$queryJ = "insert into groupmembers (userId, groupId, approved, isAdmin) values ($currentUser, $groupId, 1, 1)";
mysqli_query($conn, $queryJ);
header("location: groupschat.php?groupId=$groupId");