<?php
session_start();

if(isset($_GET['code']) && !isset($_SESSION['ACCESS_TOKEN'])) {
    $_SESSION['CODE'] = $_GET['code'];
    $_SESSION['CLIENT_SECRET'] = ''; //user instagram app client_secret

    $curl = curl_init("https://api.instagram.com/oauth/access_token");
    curl_setopt($curl,CURLOPT_POST,true);
    curl_setopt($curl,CURLOPT_POSTFIELDS,array(
        'client_id'                =>     $_SESSION['CLIENT_ID'],
        'client_secret'            =>     $_SESSION['CLIENT_SECRET'],
        'grant_type'               =>     'authorization_code',
        'redirect_uri'             =>     $_SESSION['REDIRECT_URI'],
        'code'                     =>     $_GET['code']
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result,true);

    $_SESSION['ACCESS_TOKEN'] = $result['access_token'];

    header("Location: ".'instaList.php' , true, 301);
}
