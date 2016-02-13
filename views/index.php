<?php

(!defined('__APP__') || fk::isDebugging() && (empty($_GET['t']) || $_SERVER['REQUEST_TIME'] > $_GET['t'] + 4)) && header("Location: ../index.php?t=$_SERVER[REQUEST_TIME]");

/**
 * @var string $appId
 * @var int $timestamp
 * @var string $nonceStr
 * @var string $signature
 * @var string $imgHost
 * @var \fk\web\Application $this
 */

include __DIR__ . '/story.php';
/**
 * @var array $story
 */
$marriage = 1458446400;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="screen-orientation" content="portrait"/>
    <meta name="format-detection" content="telephone=no"/>
    <title><?= $title; ?></title>
    <div style="display: none">
        <img src="<?= $imgHost; ?>/share.jpg">
    </div>
    <link rel="stylesheet" href="./css/<?= DEBUG ? "base.css?t=$_SERVER[REQUEST_TIME]" : "base.min.css?v=$this->version"; ?>">
    <script>
        var diff = new Date - <?= microtime(true) * 1000; ?>;
        var Heart = function (canvas) {
            if (arguments[1]) {
                this.size = arguments[1];
            }
            return this.draw(canvas);
        };
        Heart.prototype = {
            radius: 0,
            zero: {},
            radian: Math.PI,
            radianIncrement: Math.PI / 15,
            context: null,
            maxRadian: 3 * Math.PI,
            strokeStyle: '#FF5C5C',
            size: 100,
            coordinate: function () {
                var radian = this.radian;
                var x = this.zero.x + this.radius * (16 * Math.pow(Math.sin(radian), 3));
                var y = this.zero.y - this.radius * (13 * Math.cos(radian) - 5 * Math.cos(2 * radian) - 2 * Math.cos(3 * radian) - Math.cos(4 * radian));

                this.radian += this.radianIncrement;

                return {x: x, y: y};
            },
            draw: function (canvas) {
                this.context = canvas.getContext('2d');
                this.context.beginPath();
                this.context.strokeStyle = this.strokeStyle;
                this.context.lineWidth = 1;

                canvas.width = this.size;
                canvas.height = this.size;
                this.zero = {x: this.size / 2, y: this.size / 2};
                this.radius = this.size / 40;

                var initCoordinate = this.coordinate();
                this.context.moveTo(initCoordinate.x, initCoordinate.y);

                while (this.radian < this.maxRadian) {
                    this.registerLine();
                }
                this.context.fillStyle = this.strokeStyle;
                this.context.fill();
                return canvas;
            },
            registerLine: function () {
                var c = this.coordinate();
                this.context.lineTo(c.x, c.y);
                this.context.strokeStyle = this.strokeStyle;
                this.context.stroke();
            }
        };

    </script>
    <style>
        <?php include __DIR__ . '/style.php'; ?>
    </style>
</head>
<body >
<div class="arrow left disabled"></div>
<div class="arrow right"></div>
<div class="container">
    <div class="loading" id="stage-in"><div><canvas></canvas></div></div>
    <script>new Heart(document.querySelector('#stage-in canvas'), 2000);</script>
    <div id="music" class="paused"><audio src="<?= $this->imgHost == 'images' ? 'images' : 'http://7xqb7r.com1.z0.glb.clouddn.com/videos/inviting'; ?>/morning.mp3" loop preload></audio></div>
    <div id="heartbeats"></div>
    <div id="wrapper-mask"></div>
    <div class="wrapper">
        <div class="welcome">
            <div class="wedding-photo">
                <div></div>
            </div>
            <div class="circle" id="circle-flowers">
                <?php for($i = 0; $i < 22; $i ++): ?>
                    <div></div>
                <?php endfor; ?>
            </div>
            <div class="words font-it invisible" id="votes">
                <div>黄伍&谢凤</div>
                <div>2016年3月20日</div>
                <div class="fs-14">聚竹园酒楼</div>
                <div id="timing-to-marriage" class="fs-14" data-timing-type="marriage">
                    <span class="fs-14"><?= $marriage < $_SERVER['REQUEST_TIME'] ? (date('Y-m-d') == '2016-03-20' ? '正在进行' : '已过') : '倒计时'; ?></span>
                    <div class="font-0">
                        <?php $duration = $marriage - $_SERVER['REQUEST_TIME']; ?>
                        <i class="value day"><?= sprintf('%02d', $duration / 86400); ?></i><i class="unit day"></i>
                        <i class="value hour"><?= sprintf('%02d', $duration / 3600 % 24); ?></i><i class="unit hour"></i>
                        <i class="value minute"><?= sprintf('%02d', $duration / 60 % 60); ?></i><i class="unit minute"></i>
                        <i class="value second"><?= sprintf('%02d', $duration % 60); ?></i><i class="unit second"></i>
                    </div>
                </div>
            </div>
        </div>
        <div id="love-story" class="love-story rotateY-90" data-init="<?= $this->plan == 'A' ? 'loveStory' : 'timeLine'; ?>">
        <?php if($this->plan == 'A'): ?>
            <div>
                <div class="title">幸福时刻</div>
                <?php $duration = $_SERVER['REQUEST_TIME'] - 1030809600 + 8; ?>
                <?php foreach($story as &$s): ?>
                    <?php
                    $init = '';
                    if(!is_numeric($s[0])) {
                        $init = 'data-timing-type="story"';
                        $year = intval($duration / 86400 / 365);
                        $month = sprintf('%02d', $duration / 86400 % 365 / 30);
                        $day = sprintf('%03d', $duration / 86400 % 365);
                        $hour = sprintf('%02d', $duration / 3600 % 24);
                        $minute = sprintf('%02d', $duration / 60 % 60);
                        $second = sprintf('%02d', $duration % 60);

                        $s[1] = str_replace('{time}', <<<HTML
<span id="timing-love-story" data-timing-type="story" class="font-0">
    <i class="value year">$year</i><i class="unit year"></i>
    <i class="value month">$month</i><i class="unit month"></i>
    <i class="value day">$day</i><i class="unit day"></i>
    <i class="value hour">$hour</i><i class="unit hour"></i>
    <i class="value minute">$minute</i><i class="unit minute"></i>
    <i class="value second">$second</i><i class="unit second"></i>
</span>
HTML
                        , $s[1]);
                    }
                    ?>
                    <div class="line" <?= $init; ?>><span class="year"><?= $s[0]; ?></span><span class="story"><?= $s[1]; ?></span></div>
                <?php endforeach; ?>
                <?php if (0):  ?>
                <span>我们在</span>
                <span id="timing-love-story" data-timing-type="story" class="font-0">
                    <?php $duration = $_SERVER['REQUEST_TIME'] - 1030809600 + 8; ?>
                    <i class="value year"><?= intval($duration / 86400 / 365); ?></i><i class="unit year"></i>
                    <i class="value month"><?= sprintf('%02d', $duration / 86400 % 365 / 30); ?></i><i class="unit month"></i>
                    <i class="value day"><?= sprintf('%03d', $duration / 86400 % 365); ?></i><i class="unit day"></i>
                    <i class="value hour"><?= sprintf('%02d', $duration / 3600 % 24); ?></i><i class="unit hour"></i>
                    <i class="value minute"><?= sprintf('%02d', $duration / 60 % 60); ?></i><i class="unit minute"></i>
                    <i class="value second"><?= sprintf('%02d', $duration % 60); ?></i><i class="unit second"></i>
                </span>
                <span>前第一次<b>遇见</b></span>
                <br>
                <span class="prefix">此时，我们已<b>相恋</b></span>
                <span id="timing-being-together" class="font-0" data-timing-type="together">
                    <?php $duration = time() - 1405785600 + 8; ?>
                    <i class="value day"><?= intval($duration / 86400, 0); ?></i><i class="unit day"></i>
                    <i class="value hour"><?= sprintf('%02d', $duration / 3600 % 24); ?></i><i class="unit hour"></i>
                    <i class="value minute"><?= sprintf('%02d', $duration / 60 % 60); ?></i><i class="unit minute"></i>
                    <i class="value second"><?= sprintf('%02d', $duration % 60); ?></i><i class="unit second"></i>
                </span>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php include __APP__ . '/tree.php';?>
        <?php endif; ?>
        </div>
        <div class="album rotateY-90" data-init="albumShow" id="album">
            <?php if (fk::$app->request->terminal == 'pc'):?>
                <ul class="bg-pink" id="album-ul">
                    <?php for ($i = 1; $i <= 17; $i++): ?>
                    <li><img src="../images/photos/0.jpg"><p>One line description <?= $i; ?></p></li>
                    <?php endfor; ?>
                </ul>
            <?php else: ?>
                <div>
                    <div class="cover">
                        <div class="mask"></div>
                        <div class="start"></div>
                    </div>
                    <div class="words">我们的第一个里程碑</div>
                </div>
            <?php endif; ?>
        </div>
        <div class="movie rotateY-90" id="love-movie" data-init="movie">
            <div class="box">
                <div class="video">
                    <img src="<?= $imgHost; ?>/poster_1.jpg?v=1.0">
                    <div class="start"></div>
                    <video class="hide" src="http://7xqb7r.com1.z0.glb.clouddn.com/video/final_1.mp4" controls></video>
                </div>
            </div>
        </div>
        <div class="invitation rotateY-90" data-init="openMap">
            <div>
                <p>我们诚挚的邀请您参加我们的婚礼</p>
                <p>
                    <b>电话:</b><a href="tel:13541013371">13541013371</a>/<a href="tel:13541336629">13541336629</a><br>
                    <b>地址:</b>双流县其他航空路西段2号近紫荆电影院,聚竹园酒楼双流示范店 (028)85736222
                </p>
                <div>
                    <div id="map"></div>
                    <div id="open-map"><?= fk::$app->request->terminal == 'pc' ? '' : '打开地图'; ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($this->plan == 'A'): ?>
    <div id="menu">
        <div id="touch-us" class="touch-in"><div><div class="her"></div><div class="me"></div></div></div>
        <div id="cover"></div>
        <div id="bubble"></div>
        <div id="items" class="font-it">
            <div class="item-1" data-class="welcome">我眼里的Ta</div>
            <div class="item-2" data-class="love-story">我们de故事</div>
            <div class="item-3" data-class="album">幸福de刻印</div>
            <div class="item-4" data-class="movie">视频</div>
            <div class="item-5" data-class="invitation">地址</div>
        </div>
    </div>
    <?php endif; ?>
</div>
<div style="display: none">
    <img src="<?= $imgHost; ?>/share.jpg">
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
                $urls[] = "$imgHost/$i.jpg";
            }
            echo json_encode($urls);
        ?>,
        photoHost: '<?= $imgHost; ?>',
        shareConfig: {
            title: '<?= $title; ?>',
            desc: '我们邀请您及家人为我们见证这一美妙的时刻',
            link: '<?= "http://$_SERVER[HTTP_HOST]/index.php"; ?>',
            imgUrl: '<?= $imgHost; ?>/share.jpg'
        },
        marriage: <?= $marriage; ?>
    };
    const TERMINAL = '<?= fk::$app->request->terminal; ?>';
    const OS = '<?= fk::$app->request->isAndroid ? 'Android' : 'iOS'; ?>';
</script>
<script src="http://api.map.baidu.com/api?v=2.0&ak=1b39783ca251e9ef02ffb2fab744cdd1"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="js/iscroll-lite.js"></script>
<script src="../js/<?= DEBUG ? "base.js?t=$_SERVER[REQUEST_TIME]" : "base.min.js?v=$this->version"; ?>"></script>
</html>