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
    var imageContainer = document.getElementById('container').getElementsByClassName('image')[0];
    var canvasContainer = document.getElementById('container').getElementsByClassName('canvas')[0];
    var images = ['flying_elephant', 'kitty_with_rose']; // image names
    function downloadImage(draw) {
        var img = new Image();
        img.src = '../images/' + images.shift() + '.jpg';
        img.onload = function () {
            fk.setImage(img);
            if (images.length) {
                this.onload = null;
                downloadImage();
            }
            if (draw) {
                drawImage();
            }
            // TODO: remove dom, see if it increase efficiency
        }
    }

    downloadImage(true);
    $body.onload = function () {
        var $loading = document.getElementsByClassName('loading')[0];
        $loading.className = 'loading running';
        fk.addEvent($loading, 'animationend', function () {
            afterLoadingRemoved();
        });
        /* Blur background */
        fk.startDrawing();
    }

    function drawImage(image) {
        if (image instanceof Image) {
            fk.stopDrawing();
            fk.setImage(image);
        } else {
            image = fk.getImage();
        }

        if (image) {
            var canvas;
            if (canvas = fk.canvases[image.src]) { // Use the existed canvas
                canvas.className = 'fadeIn';
            } else { // Create new canvas
                fk.canvases[image.src] = canvas = document.createElement('canvas');
                canvas.className = 'fadeIn';
                canvasContainer.appendChild(canvas);
                stackBlurImage(image, canvas, 40);
                fk.addEvent(canvas, 'animationend', function () {
                    if (this.className == 'fadeOut' || fk.previousCanvas == canvas) {
                        return false;
                    }
                    if (fk.previousCanvas) {
                        fk.previousCanvas.className = 'fadeOut';
                    }
                    fk.previousCanvas = canvas;
                });

                // TODO: and class invisible, to see if it increase the speed(efficiency)
                //fk.addEvent(canvas, 'animationstart', function () {
                //    if (fk.previousImage < canvas) {
                //
                //    }
                //});
            }
        }
    }
    function afterLoadingRemoved() {
        document.body.removeChild(document.querySelector('.loading'));
    }

    fk.addEvent(document.querySelector('#menu'), 'touchstart', function () {
    });

    window.drawImage = drawImage;
}());