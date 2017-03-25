<?php
class CustomInstagram {

    // 내 정보 가져오기
    function getUserInfo(){
        $url = 'https://api.instagram.com/v1/users/self/?access_token='.$_SESSION['ACCESS_TOKEN'];
        $result = json_decode($this->fetchData($url));

        return $result;
    }

    // 내 전체 정보 가져오기
    // image 불러올 때는 type, size 파라미터 필요
    function getMyFeedTotalInfo($type,$size){
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$_SESSION['ACCESS_TOKEN'];
        $result = json_decode($this->fetchData($url));

        if ($type == 'image') {
            switch ($size) {
                case 'standard_resolution' :
                    return $this->getImageList($result, 'getImageList');
                case 'low_resolution' :
                    return $this->getImageList($result, 'low_resolution');
                case 'thumbnail' :
                    return $this->getImageList($result, 'thumbnail');
            }
        } else {
            return $result;
        }
    }


    // 내 피드 이미지 리스트 가져오기
    // 옵션 (큰거->작은거순) : 'standard_resolution','low_resolution','thumbnail'
    function getImageList($data,$size) {
        $list = array();


        foreach ($data->data as $data_key => $data_value) {
            $tmpImageObj = $data_value->images;

            if ($size == 'standard_resolution') {
                $list[$data_key] = $tmpImageObj->standard_resolution->url;
            } else if ($size == 'low_resolution') {
                $list[$data_key] = $tmpImageObj->low_resolution->url;
            } else {
                $list[$data_key] = $tmpImageObj->thumbnail->url;
            }
        }

        return $list;
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