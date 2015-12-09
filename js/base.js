/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */

var index = 0;
function getImage() {
    var images = ['flying_elephant', 'kitty_with_rose'];
    if (++index >=images.length) {
        index = 0;
    }
    return images[index];
}

var op = 0;
function toggleImages() {
    op = op ? 0 : 1;
    fk('.b').css('opacity', op);
    setTimeout(toggleImages, 5000);
}
toggleImages();
