<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="screen-orientation" content="portrait"/>
    <title>Home</title>
    <!--<link rel="stylesheet" href="../css/base.css">-->
    <script>document.write('<link rel="stylesheet" href="../css/base.css?t=' + (new Date).getTime() + '">')</script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        var diff = new Date - <?= microtime(true) * 1000; ?>;
    </script>
    <style>
        <?php include __DIR__ . '/core.php'; ?>
        <?php include __DIR__ . '/style.php'; ?>
    </style>
</head>
<body>
<div class="loading"></div>
<div id="container"></div>
<div class="wrapper">
    <div class="welcome">
        <div class="circle" id="circle-flowers">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            <div></div><div></div>
        </div>
        <div id="timing-being-together" class="hide font-it">
            <?php $duration = time() - 1405785600 + 6; ?>
            <div class="prefix">We have been <b>together</b> for</div>
            <i class="value day"><?= intval($duration / 86400, 0); ?></i><i class="unit day"></i>
            <i class="value hour"><?= intval($duration / 3600 % 24, 0); ?></i><i class="unit hour"></i>
            <i class="value minute"><?= intval($duration / 60 % 60, 0); ?></i><i class="unit minute"></i>
            <i class="value second"><?= intval($duration % 60); ?></i><i class="unit second"></i>
        </div>
        <div class="words hide font-it" id="votes">
            No measure of time<br>with you<br>will be long enough<br>but <br>let's start forever
        </div>
    </div>
    <div class="love-story hide rotateY-90 font-it" data-init="typeIn">
        <div id="timing-love-story" class="font-it">
            <div class="prefix">We have been <b>known each other</b> for</div>
            <i class="value year">00</i><i class="unit year"></i>
            <i class="value month">00</i><i class="unit month"></i>
            <i class="value day">00</i><i class="unit day"></i>
        </div>
        <pre class="hide">
You know when I said I knew little about love?
Well,that wasn't true
I know a lot about love
I've seen it,I've seen it centuries and centuries of it
And it was the only thing that made watching you would bearable
All this wars,pain and lies,hate
Made me want to turn away and never look down again
But to see the way that mankind love
I mean,you could search the furthest reaches the universe and never find anything more beautiful
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
    <div class="album rotateY-90" data-init="albumShow">
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
    </div>
    <!--<div class="movie rotateY-90" id="love-movie">-->

    <!--</div>-->
    <!--<div class="invitation rotateY-90">-->
        <!--It would be an honor to have you with us to witness the sacred bounding of our wedding-->
        <!--<textarea name="words"></textarea>-->
    <!--</div>-->
</div>
<div id="menu">
    <div id="touch-us" class="touch-in"><div><div class="her"></div><div class="me"></div></div></div>
    <div id="cover"></div>
    <div id="bubble"></div>
    <div id="items" class="font-it">
        <div class="item-1" data-class="welcome">时间de证明</div>
        <div class="item-2" data-class="love-story">我们de故事</div>
        <div class="item-3" data-class="album">幸福de刻印</div>
        <div class="item-4">想不出名字</div>
    </div>
</div>
</body>
<script>
<?php
/**
 * @var string $appId
 * @var int $timestamp
 * @var string $nonceStr
 * @var string $signature
 *
 */
?>
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?= $appId; ?>', // 必填，公众号的唯一标识
        timestamp: '<?= $timestamp; ?>', // 必填，生成签名的时间戳
        nonceStr: '<?= $nonceStr; ?>', // 必填，生成签名的随机串
        signature: '<?= $signature; ?>',// 必填，签名，见附录1
        jsApiList: ['previewImage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.previewImage({
        current: '../images/photos/1.jpg', // 当前显示图片的http链接
        urls: <?php
            $urls = [];
            for($i = 1; $i < 18; $i++) {
                $urls[] = "../images/photos/$i.jpg";
            }
            echo json_encode($urls);
            ?>

    });
    wx.error(function () {
        console.log(123)
    });
    document.write('<script src="../js/base.js?t=' + (new Date).getTime() + '"><\/script>');
</script>
</html>