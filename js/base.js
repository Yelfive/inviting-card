/**
 * Created by Administrator on 2015/12/12.
 */

$loading = document.getElementById('loading');
document.body.addEventListener('touchstart', function () {
    //$('#loading').css({'background-size': 500, 'opacity': 0});
    //$loading.style.backgroundSize = '500px';
    //$loading.style.opacity = 0;
    $loading.className = 'fade';
});

//var loadingImg = [500, 324];
//window.getOffsetTop = function (h) {
//    h = !h ? document.getElementById('loading').getElementsByTagName('img').item(0).clientHeight : h;
//    var t = (window.innerHeight - h) / 2;
//    alert(t)
//    return t;
//};
//(function () {
//    //$('#loading img').css({top: window.getOffsetTop(), opacity: 1}).addClass('loading-animate');
//
//}());
//$.fn.touch = function (callback) {
//    this.get(0).addEventListener('touchstart', callback, false);
//}
//$('#loading').touch(function () {
//    alert('touch!');
//});
//(function () {


//    document.body.onclick = function () {
//        alert('click');
        //var h = window.innerWidth / loadingImg[0] * loadingImg[1];
        //$('#loading').css({'background-size': 500, 'opacity': 0});
        //$('#loading').css({opacity: 0})
        //    .children('img')
        //    .css({height: h, 'top': getOffsetTop(h)});
        //setTimeout(function () {
        //    $('#loading').remove();
        //}, 500);
    //};
//}());
//
//require.config({
//    packages: [
//        {
//            name: 'zrender',
//            location: '../js/zrender',
//            main: 'zrender'
//        }
//    ]
//});
//
//require(['zrender', 'zrender/shape/Image'], function (zrender, ImageShape) {
//    return ;
//    var zr = zrender.init(document.body);
//    var image = new ImageShape({
//        position: [0, 0],
//        scale: [1, 1],
//        style: {
//            x: 0,
//            y: 0,
//            image: '../images/flying_elephant.jpg'
//        }
//    });
//    zr.addElement(image);
//    zr.render();
//
//    zr.animate(image.id, '', true)
//        .when(1000, {
//            //opacity: 0,
//            position: [100, 100]
//        })
//        //.start()
//});