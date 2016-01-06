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

    var $timing = document.getElementById('timing-being-together');

    var $body = document.body;
    $body.onload = function () {
        var $loading = document.querySelector('.loading');
        $loading.className = 'loading running';
        setTimeout(afterLoadingRemoved, 550);
    }

    function afterLoadingRemoved() {
        document.body.removeChild(document.querySelector('.loading'));
        drawCircle();
    }

    var $circle = document.getElementById('circle-flowers');
    var cw = $circle.clientWidth;
    $circle.style.height = cw + 'px';

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
    var drawCircle = function () {
        var children = $circle.children;
        var len = children.length;

        // set timing position
        $timing.style.top = cw / 2 * 0.8 + 'px';

        radius = 0.4 * cw;
        coordinate.config = {
            radius: radius,
            zero: {x: cw / 2, y: cw / 2},
            total: len,
            randomPosition: true
        };
        var i = 0;
        var tickFlowers = setInterval(function () {
            var child = children[i++];
            if (!child) {
                clearInterval(tickFlowers);
                typeIn($timing);
                return tickFlowers = null;
            }
            var c = coordinate.circle(i);
            child.style.left = (c.x - child.clientWidth / 2) + 'px';
            child.style.top = (c.y - child.clientHeight / 2) + 'px';
            child.className += ' bloom';
        }, 250);
    };

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
        var args = arguments;
        var tick = setInterval(function () {
            var current = html.substr(progress, 1);
            if (current == '<') {
                progress = html.indexOf('>', progress) + 1;
            } else {
                progress++;
            }
            // innerHTML creates end tag
            dom.innerHTML = html.substring(0, progress) + (progress & 1 && progress < html.length ? '_' : '');
            if (progress >= html.length) {
                clearInterval(tick);
                if (args[1] instanceof Function) {
                    args[1](dom);
                }
            }
        }, 75);
    }
    var initializer = {
        typeIn: typeIn,
    };
    var PageBase = function () {
        this.currentDom = document.querySelector('.wrapper>div');
        this.firstPage = this.currentDom;
        this.timeout = 500;
    }
    PageBase.prototype = {
        hasClass: function (elem, className) {
            var cls = elem.className;
            var pattern = new RegExp('\\b' + className + '\\b');
            return pattern.test(cls);
        },
        removeClass: function (elem, className) {
            var cls = elem.className;
            var pattern = new RegExp('\\b' + className + '\\b');
            elem.className = cls.replace(pattern, '').replace(/ {2,}/, ' ');
            return this;
        },
        addClass: function (elem, className) {
            if (this.hasClass(elem, className)) {
                return ;
            }
            var cls = elem.className;
            cls = !cls ? className : cls + ' ' + className;
            elem.className = cls.replace(/ {2,}/, ' ');
            return this;
        },
        prev: function () {
            var current = this.currentDom;
            var prev = current.previousElementSibling;
            if (!prev) {
                return;
            }

            this._flipTo(prev);
        },
        next: function () {
            var current = this.currentDom;
            var next = current.nextElementSibling;
            if (!next) {
                return;
            }

            this._flipTo(next);
        },
        _flipTo: function (to) {
            var $this = this;
            var current = $this.currentDom;

            $this.addClass(current, 'flip-0-90')
            setTimeout(function () {
                $this.removeClass(current, 'flip-0-90')
                    .addClass(current, 'rotateY-90')
                    .addClass(to, 'flip-90-0');

                setTimeout(function () {
                    $this.removeClass(to, 'rotateY-90').removeClass(to, 'flip-90-0');
                    if (initializer[to.dataset.init] instanceof Function) {
                        initializer[to.dataset.init](to);
                        to.dataset.init = null;
                    }
                }, $this.timeout);
            }, $this.timeout);
            this.currentDom = to;
        }
    }
    var page = new PageBase();
    window.page = page;
//return;
    var album = {
        next: function () {
            //alert(1)
            var $this = this;
            //$this.className = 'flow-out';
            //setTimeout(function () {
                $this.className = 'hide';
                //page.removeClass($this, 'flow-out');
            //}, 1000);
        }
    };
    var doms = document.querySelector('.album').getElementsByTagName('li');
    var len = doms.length;
    for (var i = 0; i < len; i++) {
        //doms[i].onclick = album.next;
        //document.querySelector('li:nth-child(2)').addEventListener('touchstart', function () {
        //    this.className = 'flow-out';
            //this.style.top = 0;
            //this.className = 'hide';
            //alert(1);
        doms[i].onclick = function () {
            this.className = 'flow-out';
            var $this = this;
            setTimeout(function () {
                $this.className = 'hide';
            }, 500);
        }
        //return ;
        //});
    }

}());