<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 20/12/2016
 * Time: 06:44 AM
 */

require_once __DIR__.'/../model/class.executive.php';

$executive = new Executive();

$member_id = $executive->clean_string($_POST['member_id']);
$session = $executive->clean_string($_POST['session']);
$post = $executive->clean_string($_POST['post']);

$executive->create_executive($member_id, $session, $post);
header('location: ../../executives.php');
