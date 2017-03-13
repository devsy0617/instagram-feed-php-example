<?php
include("config/config.php");

function fetchData($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


$tmpData = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".$CONFIG['ACCESS_TOKEN'];

$result = fetchData($tmpData);
$result = json_decode($result);





