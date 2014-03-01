<?php 
    require_once("qiniu/rs.php");
    
    $bucket = "asdfasdf";
    $accessKey = 'JZEnhuG5LiSii80jOCDDdkZIE_pjgX4CuxjhDCYF';
    $secretKey = 'v5kve_y4-8knjGVYyPYXFVaOfEm-gHje4SSK2TAE';
    
    Qiniu_SetKeys($accessKey, $secretKey);
    $putPolicy = new Qiniu_RS_PutPolicy($bucket);
    // $putPolicy->ReturnUrl = "http://localhost/7niuformupload/web/php/uploaded.php";
    $putPolicy->Expires = 1800;//过期时间
    $upToken = $putPolicy->Token(null);
    // $upToken = "JZEnhuG5LiSii80jOCDDdkZIE_pjgX4CuxjhDCYF:0bYk2v3KyfPhU006F4uyPoM1xnI=:eyJzY29wZSI6ImFzZGZhc2RmIiwiZGVhZGxpbmUiOjEzOTM2NDkyNDIsInJldHVyblVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvdXBsb2FkZWQucGhwIn0=";
    echo $upToken;
?>
<html>
    <body>
        <form method="post" action="http://up.qiniu.com/" enctype="multipart/form-data">
            <?php 
                echo "<input name=\"token\" type=\"hidden\" value=\"$upToken\">"
            ?>
            Album belonged to:
            <input type="text" name="x:album" value="albumId"><br>
            Image key in qiniu cloud storage:
            <input name="key" value="pic_dir"><br>
            <input name="key" value="pic_dir"><br>
            Image to upload:
            <input type="file" name="file"><br>
            <input type="file" name="file1"><br>
            <button type="submit">Upload</button>
        </form>
    </body>
</html>
