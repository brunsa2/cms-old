<?php
include('config.php');
include('database.php');
include('user.php');

$database = new Database();
$user = new User();

$user->setUserCredentials('brunsa2', 'amfamf');
echo $user->login();
?>