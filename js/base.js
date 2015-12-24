/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
/**
 * image size 414x736, ~130kb
 */
+(function () {
    var $body = document.body;
    $body.onload = function () {
        document.getElementsByClassName('loading').item(0).className = 'loading running';
    }
}());