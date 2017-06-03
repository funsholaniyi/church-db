<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 03/06/2016
 * Time: 4:36 PM
 */

require_once __DIR__ . '/../model/class.admin.php';

$admin = new Admin();

if (isset($_POST['login'])) {
    $username = $admin->clean_string($_POST['username']);
    $password = $admin->clean_string($_POST['password']);

    if ($row = $admin->check_admin($username, $password)) {

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['logged_in'] = true;

        header('location: ../../members.php');

    } else {
        $_SESSION['message'] = 'Invalid Login';
        header('location: ../../index.php');
    }
}
