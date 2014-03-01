<?php 
    require_once("qiniu/rs.php");

    $bucket = "asdfasdf";
    $domain = "$bucket.qiniudn.com";
    $accessKey = 'JZEnhuG5LiSii80jOCDDdkZIE_pjgX4CuxjhDCYF';
    $secretKey = 'v5kve_y4-8knjGVYyPYXFVaOfEm-gHje4SSK2TAE';
    
    $retStr = isset($_GET["upload_ret"])?$_GET["upload_ret"]:'';
    $errCode = isset($_GET["code"])?($_GET["code"]):'';
    $errMsg = isset($_GET["error"])?urldecode($_GET["error"]):'';    
    
    // if ($retStr)
        // $decodedRet = base64_decode($retStr);
        // $retObj = json_decode($decodedRet);
        // print_r($retObj);
        $key = 'cheattttt';//$retObj->{"key"};    
    
        Qiniu_SetKeys($accessKey, $secretKey);
        $client = new Qiniu_MacHttpClient(null);
        $getPolicy = new Qiniu_RS_GetPolicy(); // 私有资源得有token
        $baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
        $privateUrl = $getPolicy->MakeRequest($baseUrl, null); // 私有资源得有token    

        echo $privateUrl.'download/xxx.txt';     
?>

<html>
    <body>
        <p>UploadReult:</p>
        <?php 
            if ($retStr)
                echo "<p>$decodedRet</p>" . "<p>ImageDownloadUrl:<br>$privateUrl</p>" . "<p><img src=\"$privateUrl\"></p>";
            else
                echo "<p>error code: $errCode<br>error detail: $errMsg</p>";
        ?>        
        <p><a href="upload.php">Back to Upload</a></p>
        <p><a href="upload2.php">Back to UploadWithKey</a></p>
    </body>
</html>
