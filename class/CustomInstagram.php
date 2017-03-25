<?php
class CustomInstagram {

    // 내 정보 가져오기
    function getUserInfo(){
        $url = 'https://api.instagram.com/v1/users/self/?access_token='.$_SESSION['ACCESS_TOKEN'];
        $result = json_decode($this->fetchData($url));

        return $result;
    }

    // 내 전체 정보 가져오기
    function getMyFeedTotalInfo(){
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$_SESSION['ACCESS_TOKEN'];
        $result = json_decode($this->fetchData($url));

        return $result;
    }

    // 호출시 curl을 사용한 결과 return
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