<?php

$imgHost = 'http://7xqb7r.com1.z0.glb.clouddn.com/images/inviting';
$title = '黄伍&谢凤';
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="screen-orientation" content="portrait"/>
    <meta name="format-detection" content="telephone=no"/>
    <title><?= $title; ?></title>

    <div style="display: none"><img src="<?= $imgHost; ?>/share.jpg"></div>
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
        html,body {
            width: 100%;
            height: 100%;
        }
        body, div {
            margin: 0;
            padding: 0;
        }
        body {
            overflow: hidden;
            background-color: #ffe;
        }
        body > div:first-child {
            /*transform: ;*/

            left: 0;
            top: 0;
        }
        #loading {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            text-align: center;
            padding-top: 50%;
        }
        #loading > canvas {
            width: 50%;
        }

        <?php include __DIR__ . '/core.php'; ?>
        <?php include __DIR__ . '/video.style.php'; ?>
    </style>
</head>
<body>
    <div id="loading"><canvas></canvas></div>
    <script>new Heart(document.querySelector('#loading canvas'), 1000);</script>
    <video src="http://7xqb7r.com1.z0.glb.clouddn.com/video/final.mp4" class="video-out" poster  ></video>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    var DATA = {
        config: {
            appId: '<?= $appId; ?>',
            timestamp: '<?= $timestamp; ?>',
            nonceStr: '<?= $nonceStr; ?>',
            signature: '<?= $signature; ?>'
        },
        shareConfig: {
            title: '<?= $title; ?>',
            desc: '我们邀请您及家人为我们见证这一美妙的时刻',
            link: '<?= "http://$_SERVER[HTTP_HOST]/index.php"; ?>',
            imgUrl: 'http://7xqb7r.com1.z0.glb.clouddn.com/images/inviting/share.jpg'
        }
    };
    var Wechat = {
        wechat: wx,
        init: function () {
            //DATA.config.debug = true;
            var shareApi = ['onMenuShareAppMessage', 'onMenuShareTimeline', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone'];
            DATA.config.jsApiList = [];
            for (var i = 0, len = shareApi.length; i < len; i++) {
                DATA.config.jsApiList.push(shareApi[i]);
            }
            this.wechat.config(DATA.config);


            var self = this;
            this.wechat.ready(function () {
                for (var i = 0, len = shareApi.length; i < len; i++) {
                    self.wechat[shareApi[i]](DATA.shareConfig);
                }
            });
        }
    };
    window.onload = function () {
        return ;
        var $loading = document.querySelector('#loading');
        $loading.className = 'bounceOut';
        setTimeout(function () {
            document.body.removeChild($loading);
        }, 500);
    }
</script>
</html>