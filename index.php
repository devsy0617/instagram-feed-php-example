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

$tmpData = "https://api.instagram.com/v1/users/self/media/recent/?access_token=" . $CONFIG['ACCESS_TOKEN'];

$result = fetchData($tmpData);
$result = json_decode($result)->data;

$data = getImages($result,'standard_resolution');

// 크기별 이미지 호출 'standard_resolution','low_resolution','thumbnail'
function getImages($data, $size)
{
    $imageData = array();

    foreach ($data as $data_key => $data_value) {
        $tmpImageObj = $data_value->images;

        if($size == 'standard_resolution') {
            $imageData[$data_key] = $tmpImageObj->standard_resolution->url;
        }
        else if($size == 'low_resolution') {
            $imageData[$data_key] = $tmpImageObj->low_resolution->url;
        }
        else {
            $imageData[$data_key] = $tmpImageObj->thumbnail->url;
        }
    }

    return $imageData;
}
?>

