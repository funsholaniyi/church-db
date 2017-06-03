<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 04/06/2016
 * Time: 10:04 AM
 */

@session_start();
unset($_SESSION['logged_in']);
unset($_SESSION['user_id']);

header('location: index.php');