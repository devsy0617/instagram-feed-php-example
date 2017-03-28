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
    // 나머지는 READ ME에서 사용법 참조
    function getMyFeedTotalInfo($type,$size=null){
        $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$_SESSION['ACCESS_TOKEN'];
        $result = json_decode($this->fetchData($url));

        if ($type == 'image')
        {
            switch ($size)
            {
                case 'standard_resolution' :
                    return $this->getImageList($result->data, 'standard_resolution');
                case 'low_resolution' :
                    return $this->getImageList($result->data, 'low_resolution');
                case 'thumbnail' :
                    return $this->getImageList($result->data, 'thumbnail');
            }
        }
        elseif ($type == 'content')
        {
            return $this->getCaption($result->data);
        }
        elseif ($type == 'image_content')
        {
            $content = $this->getCaption($result->data);
            switch ($size)
            {
                case 'standard_resolution' :
                    $list = $this->getImageList($result->data, 'standard_resolution');
                case 'low_resolution' :
                    $list = $this->getImageList($result->data, 'low_resolution');
                case 'thumbnail' :
                    $list = $this->getImageList($result->data, 'thumbnail');
            }

            $image_content = array();

            foreach ($list as $list_key => $list_val) {
                $image_content[$list_key]['image'] = $list_val;
                $image_content[$list_key]['text'] = $content[$list_key]->text;
            }

            return $image_content;
        }
        else
        {
            return $result;
        }
    }


    // 내 피드 이미지 리스트 가져오기
    // size 옵션 (큰거->작은거순) : 'standard_resolution','low_resolution','thumbnail'
    function getImageList($data,$size) {
        $list = array();

        foreach ($data as $data_key => $data_value) {
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

    // 내 피드 내용 리스트 가져오기
    function getCaption($data)
    {
        $captionData = array();

        foreach ($data as $data_key => $data_value) {
            $captionData[$data_key] = $data_value->caption;
        }

        return $captionData;
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