<?php 
    require_once("qiniu/rs.php");
    
    $bucket = "a";
    $accessKey = "iN7NgwM31j4-BZacMjPrOQBs34UG1maYCAQmhdCV";
    $secretKey = "6QTOr2Jg1gcZEWDQXKOGZh5PziC2MCV5KsntT70j";
    
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
                echo "<input id='token' name=\"token\" type=\"hidden\" value=\"$upToken\">"
            ?>
            Album belonged to:
            <input type="text" name="x:album" value="albumId"><br>
            Image to upload:
            <input id="file" name="file" class="ipt" type="file" /><br>
            <input id="btn_upload" type="button" value="提交">
        </form>
    </body>
</html>

 
    <li>
        <label for="bucket">照片:</label>
        <input id="file" name="file" class="ipt" type="file" />
    </li>
    <li>
        <input id="btn_upload" type="button" value="提交">
    </li>
    <div id="progressbar"><div class="progress-label"></div></div>
 
<div id="dialog" title="上传成功"></div>

<script type="text/javascript" src="http://tizi-static.tizi.com/js/lib/jquery-1.8.2.min.js?v=2014030115"></script>
<script>
/*
 *   本示例演示七牛云存储表单上传
 *
 *   按照以下的步骤运行示例：
 *
 *   1. 填写token。需要您不知道如何生成token，可以点击右侧的链接生成，然后将结果复制粘贴过来。
 *   2. 填写key。如果您在生成token的过程中指定了key，则将其输入至此。否则留空。
 *   3. 姓名是一个自定义的变量，如果生成token的过程中指定了returnUrl和returnBody，
 *      并且returnBody中指定了期望返回此字段，则七牛会将其返回给returnUrl对应的业务服务器。
 *      callbackBody亦然。
 *   4. 选择任意一张照片，然后点击提交即可
 */
$(document).ready(function() {
    var Qiniu_UploadUrl = "http://up.qiniu.com";
    var progressbar = $("#progressbar"),
        progressLabel = $(".progress-label");
    progressbar.progressbar({
        value: false,
        change: function() {
            progressLabel.text(progressbar.progressbar("value") + "%");
        },
        complete: function() {
            progressLabel.text("Complete!");
        }
    });
    $("#btn_upload").click(function() {
        //普通上传
        var Qiniu_upload = function(f, token, key) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', Qiniu_UploadUrl, true);
            var formData, startDate;
            formData = new FormData();
            if (key !== null && key !== undefined) formData.append('key', key);
            formData.append('token', token);
            formData.append('file', f);
            var taking;
            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var nowDate = new Date().getTime();
                    taking = nowDate - startDate;
                    var x = (evt.loaded) / 1024;
                    var y = taking / 1000;
                    var uploadSpeed = (x / y);
                    var formatSpeed;
                    if (uploadSpeed > 1024) {
                        formatSpeed = (uploadSpeed / 1024).toFixed(2) + "Mb\/s";
                    } else {
                        formatSpeed = uploadSpeed.toFixed(2) + "Kb\/s";
                    }
                    var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                    progressbar.progressbar("value", percentComplete);
                    // console && console.log(percentComplete, ",", formatSpeed);
                }
            }, false);

            xhr.onreadystatechange = function(response) {
                if (xhr.readyState == 4 && xhr.status == 200 && xhr.responseText != "") {
                    var blkRet = JSON.parse(xhr.responseText);
                    console && console.log(blkRet);
                    $("#dialog").html(xhr.responseText).dialog();
                } else if (xhr.status != 200 && xhr.responseText) {

                }
            };
            startDate = new Date().getTime();
            $("#progressbar").show();
            xhr.send(formData);
        };
        var token = $("#token").val();
        if ($("#file")[0].files.length > 0 && token != "") {
            Qiniu_upload($("#file")[0].files[0], token, $("#key").val());
        } else {
            console && console.log("form input error");
        }
    })
})
</script>