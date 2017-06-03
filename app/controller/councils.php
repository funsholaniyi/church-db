<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/12/2016
 * Time: 06:44 AM
 */

require_once __DIR__.'/../model/class.council.php';

$council = new Council();

$member_id = $council->clean_string($_POST['member_id']);
$session = $council->clean_string($_POST['session']);
$post = $council->clean_string($_POST['post']);

$council->create_council($member_id, $session, $post);
header('location: ../../councils.php');
