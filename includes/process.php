<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/11/2015
 * Time: 11:15 AM
 */


require_once __DIR__."/core.php";

$core = new Core();

if (isset($_POST['save'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $room_num = $_POST['room_num'];
    $hall = $_POST['hall'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    if (!empty($firstname) && !empty($lastname) && !empty($room_num) && !empty($hall) && !empty($phone) && !empty($gender)) {

        if($core->check_phone($phone)){

            $core->add_member($firstname, $lastname, $room_num, $hall, $phone, $gender);

            $_SESSION['save_error'] = 'Details Successfully Saved';
            header("location: ../public/index.php");
            exit;

        }else{
            $_SESSION['save_error'] = 'Phone Number Already Exist, check <a href="list.php">list</a>';
            header("location: ../public/index.php");
            exit;
        }
        


    } else {
        $_SESSION['save_error'] = 'Invalid Inputs';
        header("location: ../public/index.php");
        exit;

    }
}

if (!empty($_POST['edit'])) {

    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $room_num = $_POST['room_num'];
    $hall = $_POST['hall'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    if (!empty($firstname) && !empty($lastname) && !empty($room_num) && !empty($hall) && !empty($phone) && !empty($gender)) {

        $core->edit_member($id, $firstname, $lastname, $room_num, $hall, $phone, $gender);

        $_SESSION['list_error'] = 'Details Successfully Updated';
        header("location: ../public/list.php");
        exit;
        
    } else {
        $_SESSION['edit_error'] = 'Invalid Inputs';
        header("location: ../public/edit..php?id=".$id);
        exit;

    }
}


if(!empty($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id'])){
    $id = $_GET['id'];
    $core->delete_member($id);
    $_SESSION['list_error'] = 'Record Deleted';
    header("location: ../public/list.php");
    exit;
}


if(!empty($_GET['action']) && $_GET['action'] === 'download_phone'){
    $core->save_phone_list();
    $data = file_get_contents('phones.csv');
    
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="phones.csv"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header("Content-Transfer-Encoding: binary");
    header('Pragma: public');
    header("Content-Length: " . strlen($data));
    exit($data);
}