<?php
@session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])) {
    header('location: index.php');
}
require_once __DIR__ . '/../app/model/class.member.php';
$member = new Member();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Dashboard</title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css"/>

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/libs/nanoscroller.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/libs/select2.css"/>

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="assets/css/compiled/theme_styles.css"/>
    <!-- Favicon -->

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="theme-wrapper">
    <header class="navbar" id="header-navbar">
        <div class="container">
            <a href="members.php" id="logo" class="navbar-brand">
                <h4>FCCF OAU</h4>
            </a>

            <div class="clearfix">
                <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"></span>
                </button>

                <div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
                    <ul class="nav navbar-nav pull-left">
                        <li>
                            <a class="btn" id="make-small-nav">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-no-collapse pull-right" id="header-nav">
                    <ul class="nav navbar-nav pull-right">
                        <li>
                            <a class="btn" href="#">
                                Admin
                            </a>
                        </li>
                        <li class="hidden-xxs">
                            <a class="btn" href="logout.php">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div id="page-wrapper" class="container">
        <div class="row">
