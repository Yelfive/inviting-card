/**
 * Created by Administrator on 2015/12/12.
 */

var loadingImg = [500, 324];
window.getOffsetTop = function (h) {
    h = !h ? document.getElementById('loading').getElementsByTagName('img').item(0).clientHeight : h;
    var t = (window.innerHeight - h) / 2;
    return t;
};
+(function () {
    $('#loading img').css({top: window.getOffsetTop()});

    $('#menu').click(function () {
        alert('Clicked!');
    });
}());

+(function () {
    document.onclick = function () {
        var h = window.innerWidth / loadingImg[0] * loadingImg[1];
        $('#loading').css({opacity: 0})
            .children('img')
            .css({height: h, 'margin-bottom': getOffsetTop(h)});
            //.css({height: h, top: getOffsetTop(h)});
        setTimeout(function () {
            $('#loading').remove();
        }, 500);
    };
}());