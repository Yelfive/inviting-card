<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="screen-orientation" content="portrait"/>
    <style>
        html,body {
            width: 100%;
            height: 100%;
            background-color: grey;
        }
        body {
            max-height: 800px;
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffe;
        }
        #container {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .leaf {
            width: 100px;
            height: 100px;
            background-color: #1AAD1A;
            border-radius: 70% 0 100%;
            display: inline-block;
            -webkit-transform-origin: 0 100%;
            position: absolute;
            -webkit-transform: rotate(0deg) scale(0);
            transform: rotate(0deg) scale(0);
            -webkit-transition: -webkit-transform 1s;
            transition: transform 1s;
        }
        .leaf:before {
            content: '';
            display: inline-block;
        }
        .leaf:after {
            content: '';
            display: inline-block;
        }
        .branch {
            height: 700px;
            width: 1rem;
            display: inline-block;
            background-color: #944900;
            position: absolute;
            top: 100px;
            left: 100px;
            -webkit-animation: grow 8s linear;
            animation: grow 8s linear;
            transform-origin: 0 100%;
            -webkit-transform-origin: 0 100%;
        }
        .leaf.show {
            transform-origin: 0 100%;
            -webkit-transform-origin: 0 100%;
        }

        @keyframes grow {
            0% {transform: scale(1, 0)}
            100% {transform: scale(1, 1)}
        }

        @-webkit-keyframes grow {
            0% {-webkit-transform: scale(1, 0)}
            100% {-webkit-transform: scale(1, 1)}
        }
    </style>
</head>
<body style="height: 800px;">
    <div id="container">
        <div class="branch"></div>
        <?php for($i = 0 ; $i < 8; $i++): ?>
            <style>
                .show<?= $i; ?> {
                    transform: <?= $i & 1 ? 'rotate(20deg) scale(1)' : 'rotate(-120deg) scale(0.5)'; ?>;
                    -webkit-transform: <?= $i & 1 ? 'rotate(20deg) scale(1)' : 'rotate(-120deg) scale(0.5)'; ?>;
                }
            </style>
            <div class="leaf" style="left: <?= $i & 1 ? 116: 100; ?>px; top: <?= $i * 95; ?>px;"></div>
        <?php endfor;?>
    </div>
    <script>
        (function(){
            function toTop() {
                //
            }
            var $DOMS = document.querySelectorAll('.leaf');
            var i = $DOMS.length - 1;
            var t = setInterval(function () {
                if (!$DOMS[i]) {
                    return clearInterval(t);
                }
                $DOMS[i].className = 'leaf show'+i;
                i--;
            }, 1000);
            var j = 0;
            var tt = setInterval(function () {
                if (!$DOMS[i]) {
                    return clearInterval(tt);
                }
                console.log(500 - j)
                window.scrollTo(0, 400 - j);
                if (j < 500) {
                    j += 2;
                }

            }, 50);
        }());
    </script>
</body>
</html>