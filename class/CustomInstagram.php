<?php
class CustomInstagram {

    function getUserInfo(){
        $url = 'https://api.instagram.com/v1/users/self/?access_token='.$_SESSION['ACCESS_TOKEN'];
        return $url;
    }

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

}