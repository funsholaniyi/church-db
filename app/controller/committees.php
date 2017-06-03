<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/12/2016
 * Time: 06:44 AM
 */

require_once __DIR__.'/../model/class.committee.php';

$committee = new Committee();

$name = $committee->clean_string($_POST['committee_name']);
$member_id = $committee->clean_string($_POST['member_id']);
$session = $committee->clean_string($_POST['session']);
$post = $committee->clean_string($_POST['post']);

$committee->create_committee($name, $member_id, $session, $post);
header('location: ../../committees.php');
