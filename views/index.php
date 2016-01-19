<?php

defined('__APP__') or header("Location: ../index.php?t=$_SERVER[REQUEST_TIME]");

fk::isDebugging() && (empty($_GET['t']) || $_SERVER['REQUEST_TIME'] > $_GET['t'] + 10) && header("Location: ../index.php?t=$_SERVER[REQUEST_TIME]");
/**
 * @var string $appId
 * @var int $timestamp
 * @var string $nonceStr
 * @var string $signature
 *
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="screen-orientation" content="portrait"/>
    <title>Home</title>
    <!--<link rel="stylesheet" href="../css/base.css">-->
    <script>document.write('<link rel="stylesheet" href="../css/base.css?t=' + (new Date).getTime() + '">')</script>
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
    <div id="music" class="paused"><audio src="./medias/bg.mp3" loop="true" preload="true"></audio></div>
    <div id="heartbeats"></div>
    <div class="wrapper">
        <div class="welcome">
            <div class="circle" id="circle-flowers">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div>
            </div>
            <div id="timing-being-together" class="invisible font-it">
                <?php $duration = time() - 1405785600 + 6; ?>
                <div class="prefix">We have been <b>together</b> for</div>
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
                <div id="timing-love-story" class="font-it">
                    <div class="prefix">We have been <b>known each other</b> for</div>
                    <i class="value year">00</i><i class="unit year"></i>
                    <i class="value month">00</i><i class="unit month"></i>
                    <i class="value day">00</i><i class="unit day"></i>
                </div>
            <pre>
                You know when I said I knew little about love?
                Well,that wasn't true
                I know a lot about love
                I've seen it,I've seen it centuries and centuries of it
                And it was the only thing that made watching you would bearable
                All this wars,pain and lies,hate
                Made me want to turn away and never look down again
                But to see the way that mankind love
                I mean,
                you could search the furthest reaches the universe and never find anything more beautiful
                so,yes,I know that love is unconditional
                But I also know it can be unpredictable,unexpected,uncontrollable,unbearable
                and,well,strangely easy to mistake for loathing
                And,what I'm trying to say is
                I think I love you
                My heart,it fells like my chest can barely contain it
                Like it doesn't belong to me anymore,it belongs to you
                And if you wanted it,I'd wish for nothing to exchange
                No gifts,no goods,no demonstrations for devotion
                Nothing but knowing you love me too
                Just your heart
                In exchange for mine
            </pre>
            </div>
        </div>
        <div class="album rotateY-90" data-init="">
            <?php if (fk::$app->request->terminal == 'pc'):?>
                <ul class="bg-pink" id="album-ul">
                    <li><img src="../images/photos/0.jpg"><p>One line description 1</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 2</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 3</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 4</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 5</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 6</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 7</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 8</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 9</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 10</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 11</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 12</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 13</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 14</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 15</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 16</p></li>
                    <li><img src="../images/photos/0.jpg"><p>One line description 17</p></li>
                </ul>
            <?php else: ?>
                <img src="../images/photos/pc_cover.jpg">
            <?php endif; ?>
        </div>
        <div class="movie rotateY-90" id="love-movie">
            我是视频么么哒
        </div>
        <div class="invitation rotateY-90" data-init="openMap">
            It would be an honor to have you with us to witness the sacred bounding of our wedding
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
                $urls[] = "http://$_SERVER[HTTP_HOST]/images/photos/$i.jpg";
            }
            echo json_encode($urls);
        ?>
    };
    const TERMINAL = '<?= fk::$app->request->terminal; ?>';
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="../js/base.js?t=<?= time(); ?>"></script>
</html>