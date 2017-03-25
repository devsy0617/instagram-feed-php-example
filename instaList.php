<?php
session_start();
include("class/CustomInstagram.php");

$instaObj = new CustomInstagram();
$imageList = $instaObj->getMyFeedTotalInfo('image','low_resolution');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/flip.css">
</head>
<body>

<?php foreach ($imageList as $image) { ?>
<div class="flip-container">
    <div class="flipper">
        <div class="front">
            <img src="<?=$image?>">
        </div>

        <div class="back">
            back
        </div>
    </div>
</div>
   <?php }?>

</body>
</html>