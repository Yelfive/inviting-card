/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * image size 414x736, ~130kb
 *
 * TODO: render one image before loading fades out
 *
 */
+(function () {
    const BG_INTERVAL = 50000;
    var $body = document.body;
    var fk = {
        previousCanvas: false,
        images: [], // array of image dom(s)
        previousImage: '', // index from fk.images
        canvases: {},  // canvas dom(s)
        setImage: function (img) {
            this.images.push(img);
        },
        getImage: function () {
            var index;
            index = (Math.random() * (fk.images.length - 1)).toFixed();
            if (index == fk.previousImage) {
                index = index == 0 ? 1 : 0;
            }
            fk.previousImage = index;
            return fk.images[index];
        },
        addEvent: function (elem, event, callback) {
            if (elem.addEventListener) {
                elem.addEventListener(event, callback, true);
            } else {
                alert('Failed to add event');
            }
        },
        tick: {},
        startDrawing: function () {
            this.tick.drawing = setInterval(drawImage, BG_INTERVAL);
        },
        stopDrawing: function () {
            var drawing;
            if (drawing = this.tick.drawing) {
                this.tick.drawing = clearInterval(drawing);
            }
        }
    };
    $body.onload = function () {
        var $loading = document.getElementsByClassName('loading')[0];
        $loading.className = 'loading running';
        fk.addEvent($loading, 'animationend', function () {
            afterLoadingRemoved();
        });
    }

    function afterLoadingRemoved() {
        document.body.removeChild(document.querySelector('.loading'));
    }

    fk.addEvent(document.querySelector('#menu'), 'touchstart', function () {
    });

}());