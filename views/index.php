<?php

(!defined('__APP__') || fk::isDebugging() && (empty($_GET['t']) || $_SERVER['REQUEST_TIME'] > $_GET['t'] + 4)) && header("Location: ../index.php?t=$_SERVER[REQUEST_TIME]");
/**
 * @var string $appId
 * @var int $timestamp
 * @var string $nonceStr
 * @var string $signature
 *
 */

$host = 'http://7xqb7r.com1.z0.glb.clouddn.com/images/inviting';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="screen-orientation" content="portrait"/>
    <meta name="format-detection" content="telephone=no"/>
    <title>Home</title>
    <link rel="stylesheet" href="./css/base.css?t=<?= $_SERVER['REQUEST_TIME']; ?>">
    <script>
        var diff = new Date - <?= microtime(true) * 1000; ?>;
    </script>
    <style>
        <?php include __DIR__ . '/core.php'; ?>
        <?php include __DIR__ . '/style.php'; ?>
    </style>
</head>
<body>
<div class="container">
    <div class="loading"></div>
    <div id="music" class="paused"><audio src="./medias/bg.mp3" loop></audio></div>
    <div id="heartbeats"></div>
    <div class="wrapper">
        <div class="welcome">
            <div class="circle" id="circle-flowers">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div>
            </div>
            <div id="timing-being-together" class="invisible font-it">
                <?php $duration = time() - 1405785600 + 8; ?>
                <div class="prefix">此时，我们已<b>相恋</b></div>
                <i class="value day"><?= intval($duration / 86400, 0); ?></i><i class="unit day"></i>
                <i class="value hour"><?= intval($duration / 3600 % 24, 0); ?></i><i class="unit hour"></i>
                <i class="value minute"><?= intval($duration / 60 % 60, 0); ?></i><i class="unit minute"></i>
                <i class="value second"><?= intval($duration % 60); ?></i><i class="unit second"></i>
            </div>
            <div class="words font-it invisible" id="votes">
                No measure of time<br>with you<br>will be long enough<br>but <br>let's start forever
            </div>
        </div>
        <div class="love-story rotateY-90 font-it" data-init="typeIn">
            <div class="invisible">
                <div>我们在</div>
                <div id="timing-love-story" class="font-it">
                    <i class="value year">00</i><i class="unit year"></i>
                    <i class="value month">00</i><i class="unit month"></i>
                    <i class="value day">000</i><i class="unit day"></i>
                    <i class="value hour">00</i><i class="unit hour"></i>
                    <i class="value minute">00</i><i class="unit minute"></i>
                    <i class="value second">00</i><i class="unit second"></i>
                </div>
                <div>前第一次<b>遇见</b></div>
            </div>
        </div>
        <div class="album rotateY-90" data-init="">
            <?php if (fk::$app->request->terminal == 'pc'):?>
                <ul class="bg-pink" id="album-ul">
                    <?php for ($i = 1; $i <= 17; $i++): ?>
                    <li><img src="../images/photos/0.jpg"><p>One line description <?= $i; ?></p></li>
                    <?php endfor; ?>
                </ul>
            <?php else: ?>
                <img src="<?= $host; ?>/pc_cover.jpg">
            <?php endif; ?>
        </div>
        <div class="movie rotateY-90" id="love-movie">
            <div class="box">
                <div class="video">
<!--                    <video src=""></video>-->
                    <img src="../images/movie_cover.jpg" class="movie">
                    <img src="../images/tv.png" class="tv">
                </div>
            </div>
        </div>
        <div class="invitation rotateY-90" data-init="openMap">
            <div>
<!--                <p>It would be an honor to have you with us to witness the sacred bounding of our wedding.</p>-->
                <p>我们诚挚的邀请您参加我们的婚礼</p>
                <p><b>地址:</b>双流县其他航空路西段2号近紫荆电影院,聚竹园酒楼双流示范店 (028)85736222</p>
                <div>
                    <div id="map"></div>
                    <button id="open-map">窗口打开</button>
                </div>
            </div>
        </div>
    </div>
    <div id="menu">
        <div id="touch-us" class="touch-in"><div><div class="her"></div><div class="me"></div></div></div>
        <div id="cover"></div>
        <div id="bubble"></div>
        <div id="items" class="font-it">
            <div class="item-1" data-class="welcome">时间de证明</div>
            <div class="item-2" data-class="love-story">我们de故事</div>
            <div class="item-3" data-class="album">幸福de刻印</div>
            <div class="item-4" data-class="movie">视频</div>
            <div class="item-5" data-class="invitation">地址</div>
        </div>
    </div>
</div>
</body>
<script>
    var DATA = {
        config: {
            appId: '<?= $appId; ?>',
            timestamp: '<?= $timestamp; ?>',
            nonceStr: '<?= $nonceStr; ?>',
            signature: '<?= $signature; ?>'
        },
        images: <?php
            $urls = [];
            for($i = 1; $i < 18; $i++) {
                $urls[] = "$host/$i.jpg";
            }
            echo json_encode($urls);
        ?>
    };
    const TERMINAL = '<?= fk::$app->request->terminal; ?>';
</script>
<script src="http://api.map.baidu.com/api?v=2.0&ak=1b39783ca251e9ef02ffb2fab744cdd1"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="../js/base.js?t=<?= time(); ?>"></script>
<script>
    var map = new BMap.Map("map");
    var point = new BMap.Point(103.9207520000 , 30.6064530000);  // longitude, latitude
    map.centerAndZoom(point, 15);

    var marker = new BMap.Marker(point);        // 创建标注
    map.addOverlay(marker);                     // 将标注添加到地图中

</script>
</html>