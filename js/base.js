/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
/**
 * image size 414x736, ~130kb
 */
+(function () {
    const BG_INTERVAL = 2000;
    var $body = document.body;
    var fk = {
        images: [], // image dom
        addEvent: function (elem, event, callback) {
            if (elem.addEventListener) {
                elem.addEventListener(event, callback, true);
            }
        }
    };
    var imageContainer = document.getElementById('container').getElementsByClassName('image')[0];
    var canvasContainer = document.getElementById('container').getElementsByClassName('canvas')[0];
    var images = ['flying_elephant', 'kitty_with_rose']; // image names
    function downloadImage () {
        var img = new Image();
        img.src = '../images/' + images.shift() + '.jpg';
        imageContainer.appendChild(img);

        img.onload = function () {
            fk.images.push(img);
            if (images.length) {
                downloadImage();
            }
            // TODO: remove dom, see if it increase efficiency
        }
    }
    downloadImage();
    window.fk = fk;
    $body.onload = function () {
        var $loading = document.getElementsByClassName('loading')[0];
        $loading.className = 'loading running';
        fk.addEvent($loading, 'animationend', function () {
            afterLoadingRemoved();
        });
        /* Blur background */
        //setTimeout(drawImage, 2000);
        //setTimeout(drawImage, 4000);
        setInterval(function () {
           drawImage();
        }, BG_INTERVAL);
    }

    function drawImage() {
        var image = fk.images[parseInt(Math.random().toFixed(0) * (fk.images.length - 1))];
        //var image = fk.images.shift();
        if (image) {
            var canvas = document.createElement('canvas');
            canvasContainer.appendChild(canvas);
            stackBlurImage(image, canvas, 40);
            fk.addEvent(canvas, 'animationend', function () {
                setTimeout(function () {
                    canvasContainer.removeChild(canvas);
                }, 1500);
            })
        }
    }

    function afterLoadingRemoved() {
        document.body.removeChild(document.querySelector('.loading'));
    }

    fk.addEvent(document.querySelector('#menu'), 'touchstart', function () {
    });
}());