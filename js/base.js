/**
 * Created by Administrator on 2015/12/12.
 */


document.onclick = function () {
    $('#loading').css({opacity: 0})
        .children('img')
        .css({left: 100, top: 300, width: 500, height: 324});
    return;
    var loading = document.querySelector('#loading');
    var style = loading.style;
    loading.style.opacity = 0;
    loading.style.width = '150%';
    loading.style.height = '150%';
    style.left = '-100px';
    style.top = '-100px';
};