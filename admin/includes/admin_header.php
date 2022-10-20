<!-- Need this to buffer our request in the header of the script -->
<!-- Output buffer -->
<?php ob_start(); ?>
<!-- Starting Session -->
<?php session_start(); ?>

<?php include_once "../includes/db.php"; ?>
<?php include_once "functions.php"; ?>

<!-- Checking user role and allowing to login -->
<!-- Also block users who are not admin and does not have correct credenitials -->
<?php 

    // Block users who do not have right credentials
    if(!isset($_SESSION['user_role'])){ // Block users who do not have right credentials

        header("Location: ../index.php");
    }else if(isset($_SESSION['user_role'])){ // Block users who do not have admin rights

        if($_SESSION['user_role'] == "subscriber"){

            // As subscriber function not defined
            header("Location: ../includes/logout.php");
        }

    }    

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">