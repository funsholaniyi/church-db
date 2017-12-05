<?php session_start();
if (!empty($_GET['checked'])) {
    $read_file = 'app/config/constants.tmp.inc';
    $write_file = 'app/config/constants.inc';

    $content = @file_get_contents($read_file);
    if (!empty($content)) {
        file_put_contents($write_file, $content);
        unlink($read_file);
    }
}
require_once __DIR__ . '/app/model/class.member.php';
$member = new Member();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 max-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Login</title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css"/>

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/libs/nanoscroller.css"/>

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="assets/css/compiled/theme_styles.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css"/>

    <!-- google font libraries -->
    <link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- global scripts -->

    <script src="assets/js/jquery.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->


</head>
<body id="login-page">
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div id="login-box">
                <div id="login-box-holder">
                    <div class="row">
                        <div class="col-xs-12">
                            <header id="login-header">
                                <div id="login-logo">
                                    <h4>SOH Database</h4>
                                </div>
                            </header>
                            <?php if (!empty($_SESSION['message'])) {
                                ?>
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <strong>Error:</strong>
                                    <?= $_SESSION['message'] ?>

                                </div>
                                <?php
                                unset($_SESSION['message']);
                            }
                            ?>
                            <div id="login-box-inner">
                                <form role="form" method="post" action="app/controller/login.php">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="username" name="username" class="form-control" type="text"
                                               placeholder="Username"
                                               required>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input id="password" name="password" class="form-control" type="password"
                                               placeholder="Password"
                                               required>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn col-xs-12"
                                                    style="background-color: #005F39; color: #ffffff" name="login">LOGIN
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- global scripts -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.nanoscroller.js"></script>

<!-- this page specific scripts -->


<!-- theme scripts -->
<script src="assets/js/scripts.js"></script>

<!-- this page specific inline scripts -->

</body>
</html>