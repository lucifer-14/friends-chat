<?php
include "config.php";
include "helper.php";
if (!isset($_SESSION['userId'])) {
    header("location:login.php");  
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Friends-Chat</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="images/savage_logo.png" sizes="128x128" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="components/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="components/fontawesome-free/css/v4-shims.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="components/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="components/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="components/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="components/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <link rel="stylesheet" href="components/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="components/select2/css/select2.min.css">
    <link rel="stylesheet" href="components/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="components/DataTables/datatables.min.css">
    <link rel="stylesheet" href="components/DataTables/Responsive-2.2.5/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
</head>