<?php 
    require_once("qiniu/rs.php");
    
    $bucket = "asdfasdf";
    $accessKey = 'JZEnhuG5LiSii80jOCDDdkZIE_pjgX4CuxjhDCYF';
    $secretKey = 'v5kve_y4-8knjGVYyPYXFVaOfEm-gHje4SSK2TAE';
    
    Qiniu_SetKeys($accessKey, $secretKey);
    $putPolicy = new Qiniu_RS_PutPolicy($bucket);
    $putPolicy->ReturnUrl = "http://localhost/uploaded.php";
    $upToken = $putPolicy->Token(null);
    #echo $upToken;
?>
<html>
    <body>
        <form method="post" action="http://up.qiniu.com/" enctype="multipart/form-data">
            <?php 
                echo "<input name=\"token\" type=\"hidden\" value=\"$upToken\">"
            ?>
            Album belonged to:
            <input type="text" name="x:album" value="albumId"><br>
            Image to upload:
            <input type="file" name="file"><br>
            <input type="file" name="file"><br>
            <button type="submit">Upload</button>
        </form>
    </body>
</html>
