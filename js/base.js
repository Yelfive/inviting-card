/**
 * Created by Administrator on 2015/12/12.
 */


setTimeout(function () {
    var loading = document.querySelector('#loading');
    var style = loading.style;
    loading.style.opacity = 0;
    loading.style.width = '150%';
    loading.style.height = '150%';
    style.left = '-100px';
    style.top = '-100px';
},1000);