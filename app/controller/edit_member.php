<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 14/12/2016
 * Time: 02:03 PM
 */
require_once __DIR__ . '/../model/class.member.php';

$member = new Member();

$id = $member->clean_string($_POST['member_id']);

$salutation = $member->clean_string($_POST['salutation']);
$firstname = $member->clean_string($_POST['firstname']);
$middlename = $member->clean_string($_POST['middlename']);
$surname = $member->clean_string($_POST['surname']);
$nickname = $member->clean_string($_POST['nickname']);
$department = $member->clean_string($_POST['department']);
$phone1 = $member->clean_string($_POST['phone1']);
$phone2 = $member->clean_string($_POST['phone2']);
$email = $member->clean_string($_POST['email']);
$stateoforigin = $member->clean_string($_POST['state_of_origin']);
$stateofresidence = $member->clean_string($_POST['state_of_residence']);
$address = $member->clean_string($_POST['address']);
$homeparish = $member->clean_string($_POST['home_parish']);
$dob = $member->clean_string($_POST['dob']);
$subgroup = $member->clean_string($_POST['subgroup']);
$subgroup = json_encode($subgroup);
$admissionyear = $member->clean_string($_POST['admission_year']);
$graduationyear = $member->clean_string($_POST['graduation_year']);
$biography = $member->clean_string($_POST['biography']);

$member->update_member($id,$salutation, $firstname, $middlename, $surname, $nickname, $department, $phone1, $phone2, $email, $stateoforigin, $stateofresidence, $address, $homeparish, $dob, $subgroup, $admissionyear, $graduationyear, $biography);

header('location: ../../members.php');
