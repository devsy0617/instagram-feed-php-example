<?php
//Authentication
session_start();

$_SESSION['CLIENT_ID'] = $_POST['client_id'];
$_SESSION['CLIENT_SECRET'] = $_POST['client_secret'];
$_SESSION['REDIRECT_URI'] = $_POST['redirect_uri'];

$auth_url = 'https://api.instagram.com/oauth/authorize/?client_id='.$_SESSION['CLIENT_ID'].'&redirect_uri='.$_SESSION['REDIRECT_URI'].'&response_type=code';

header("Location: ".$auth_url , true, 301);
?>

