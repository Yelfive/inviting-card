/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
"use strict"
var index = 0;
function getImage() {
    var images = ['flying_elephant', 'kitty_with_rose'];
    if (++index >=images.length) {
        index = 0;
    }
    return images[index];
}

var op = 0;
var operand = '-';
function toggleImages() {
    //op = op ? 0 : 1;
    var duration = 2000;
    var step = 1;

    var tick = setInterval(function () {
        if (operand == '-') {
            op -= step;
        } else {
            op += step;
        }
        if (op <= 0) {
            op =0
            operand = '+';
            clearInterval(tick);
        } else if (op >= 1) {
            op = 1;
            operand = '-';
            clearInterval(tick);
        }
        fk('.b').css('opacity', op);
    }, duration * 0.02);
    setTimeout(toggleImages, 2000);
}
//toggleImages();
document.getElementById('blur').onload = function () {
    stackBlurImage( "blur", "canvas", 40, false );
}
document.getElementById('blur2').onload = function () {
    stackBlurImage( "blur2", "canvas2", 40, false );
}
var op =1;
function toggleImages2  () {
    op = op ? 0 : 1;
    document.getElementById('canvas2').style.opacity = op;
    setTimeout(toggleImages2, 2000);
}
toggleImages2();
