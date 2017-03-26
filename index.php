<?php
session_start();

if (isset($_GET['code']) && !isset($_SESSION['ACCESS_TOKEN'])) {
    $_SESSION['CODE'] = $_GET['code'];

    $curl = curl_init("https://api.instagram.com/oauth/access_token");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        'client_id' => $_SESSION['CLIENT_ID'],
        'client_secret' => $_SESSION['CLIENT_SECRET'],
        'grant_type' => 'authorization_code',
        'redirect_uri' => $_SESSION['REDIRECT_URI'],
        'code' => $_GET['code']
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, true);

    $_SESSION['ACCESS_TOKEN'] = $result['access_token'];
    header("Location: " . 'instaList.php', true, 301);

} else if (isset($_SESSION['ACCESS_TOKEN'])) {
    header("Location: " . 'instaList.php', true, 301);
}

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="js/access-token-process.js"></script>

<div class="content">
    <p class="title">원하는 제스쳐를 선택하세요</p>

    <div class="input-area-wrap">
        <div id="not-access-token" class="access-btn" data-target="#not-access-token-input">
            <p>엑세스 토큰 얻기</p>
        </div>

        <div id="access-token" class="access-btn" data-target="#access-token-input">
            <p>인스타 리스트 보러가기</p>
        </div>

        <div class="clear"></div>

        <div id="not-access-token-input" class="token-input">
            <form method="post" action="getAccessToken.php">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2" class="td-center">ASSESS_TOKEN을 얻기 위해 정보를 입력해주세요. (사용법 read me 필독)</td>
                    </tr>
                    <tr>
                        <th>CLIENT ID</th>
                        <td class="token-input-td"><input type="text" name="client_id"></td>
                    </tr>

                    <tr>
                        <th>CLIENT SECRET</th>
                        <td class="token-input-td"><input type="text" name="client_secret"></td>
                    </tr>

                    <tr>
                        <th>REDIRECT URI</th>
                        <td class="token-input-td"><input type="text" name="redirect_uri"></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="token-input-td"><input type="submit" value="확인" class="btn-submit"></td>
                    </tr>
                </table>

            </form>
        </div>

        <div id="access-token-input" class="token-input">
            <form method="post" action="instaList.php">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td colspan="2" class="td-center">ASSESS_TOKEN을 입력해주세요.</td>
                    </tr>
                    <tr>
                        <th>ACCESS TOKEN</th>
                        <td class="token-input-td"><input type="text" name="client_id"></td>
                    </tr>

                    <tr>
                        <td colspan="2" class="token-input-td"><input type="submit" value="확인" class="btn-submit"></td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>
