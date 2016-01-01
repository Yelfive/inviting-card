/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * image size 414x736, ~130kb
 *
 * TODO: render one image before loading fades out
 *
 */
+(function () {
    function isHorizon() {
        return window.orientation !== undefined && window.orientation !== 0;
    }

    if (isHorizon()) {
        return alert('Please place your phone vertically.');
    }
    var $body = document.body;
    var $timing = document.getElementById('timing-being-together');
    var fk = {
        addEvent: function (elem, event, callback) {
            if (elem.addEventListener) {
                elem.addEventListener(event, callback, true);
            } else {
                alert('Failed to add event');
            }
        },
        tick: {}
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

    var coordinate = {
        config: {
            radius: 0,
            zero: {x: 0, y: 0},
            total: 0,
            randomPosition: true
        },
        circle: function (count) {
            if (this.config.total > 0 && this.config.radius > 0) {
                var radian = 2 * Math.PI * count / this.config.total;
                if (this.config.randomPosition === true) {
                    radian += Math.random() * Math.PI / 18;
                }
                return {
                    x: this.config.zero.x + this.config.radius * Math.cos(radian),
                    y: this.config.zero.y + this.config.radius * Math.sin(radian)
                }
            } else {
                throw new Error('Invalid config for coordinate.');
            }
        }
    };
    (function () {
        var $circle = document.getElementById('circle-flowers');
        var children = $circle.children;
        var len = children.length;
        var cw = $circle.clientWidth;

        // set timing position
        $timing.style.top = cw / 2 * 0.8 + 'px';

        radius = 0.4 * cw;
        coordinate.config = {
            radius: radius,
            zero: {x: cw / 2, y: cw / 2},
            total: len,
            randomPosition: true
        };
        $circle.style.height = cw;
        var i = 0;
        fk.tick.flowers = setInterval(function () {
            var child = children[i++];
            if (!child) {
                clearInterval(fk.tick.flowers);
                typeIn($timing);
                return fk.tick.flowers = null;
            }
            var c = coordinate.circle(i);
            child.style.left = (c.x - child.clientWidth / 2) + 'px';
            child.style.top = (c.y - child.clientHeight / 2) + 'px';
            child.className += ' bloom';
        }, 500);
    }());

    typeIn(document.getElementById('votes'));
    /**
     * @param {HTMLElement} dom
     * @param {Function} $afterType
     */
    function typeIn(dom) {
        if (!(dom instanceof HTMLElement)) {
            return;
        }
        var html = dom.innerHTML.replace(/ {2,}/g, ' ');
        dom.innerHTML = '';
        dom.style.display = 'block';

        var progress = 0;
        var tick = setInterval(function () {
            var current = html.substr(progress, 1);
            if (current == '<') {
                progress = html.indexOf('>', progress) + 1;
            } else {
                progress++;
            }
            // innerHTML creates end tag
            dom.innerHTML = html.substring(0, progress) + (progress & 1 && progress < html.length? '_' : '');
            if (progress >= html.length) {
                clearInterval(tick);
                if (arguments[1] instanceof Function) {
                    arguments[1](dom);
                }
            }
        }, 75);
    }

}());