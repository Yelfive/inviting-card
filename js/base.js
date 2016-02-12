/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * image size 414x736, ~130kb
 *
 */
+(function () {
    function isLandscape() {
        return window.orientation !== undefined && window.orientation !== 0;
    }

    //window.onresize = function () {
    //    location.reload();
    //};

    if (isLandscape()) {
        return alert('竖屏效果更好哟~');
    }

    document.ontouchmove = function (event) {
        return event.preventDefault();
    };

    const $VIDEO = document.querySelector('#love-movie video');

    function addEvent(elem, eventName, callback) {
        return elem.addEventListener(eventName, callback, false);
    }

    const $TIMING_TOGETHER = document.querySelector('#timing-being-together');
    var Wechat = {
        wechat: typeof wx === 'undefined' ? null : wx,
        init: function () {
            if (!this.wechat) {
                return;
            }
            //DATA.config.debug = true;
            var shareApi = ['onMenuShareAppMessage', 'onMenuShareTimeline', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone'];
            DATA.config.jsApiList = ['previewImage', 'openLocation'];
            for (var i = 0, len = shareApi.length; i < len; i++) {
                DATA.config.jsApiList.push(shareApi[i]);
            }
            this.wechat.config(DATA.config);

            var self = this;
            this.wechat.ready(function () {
                DATA.shareConfig.fail = function () {
                    console.log(arguments);
                };
                for (var i = 0, len = shareApi.length; i < len; i++) {
                    self.wechat[shareApi[i]](DATA.shareConfig);
                }
            });
        },
        previewImage: function () {
            var config = {
                current: DATA.images[0],
                urls: DATA.images
            };
            if (arguments[0]) {
                config.complete = arguments[0];
            }
            this.wechat.previewImage(config);
        },
        openLocation: function () {
            var config = {
                fail: function (a) {
                    alert(a.errMsg);
                },
                latitude: 30.6001688195,
                longitude: 103.9143360720,
                name: '双流聚竹园酒楼',
                address: '双流县其他航空路西段2号近紫荆电影院,聚竹园酒楼双流示范店 (028)85736222',
                scale: 20, // 1~28,
                infoUrl: 'abc'
            };
            if (arguments[0] && arguments[0] instanceof Function) {
                config.complete = arguments[0];
            }
            this.wechat.openLocation(config);
        }
    };
    Wechat.init();

    function showTutorials() {
        var isNew = localStorage.new_visitor == 1;
        localStorage.new_visitor = 1;
        return isNew;
    }

    var $body = document.body;
    window.onload = function () {
        var $loading = document.querySelector('.loading');
        $loading.className = 'loading running';
        setTimeout(afterLoadingRemoved, 550);
        Album.init();
    };

    function afterLoadingRemoved() {
        $body.querySelector('.container').removeChild(document.querySelector('.loading'));
        typeIn(document.getElementById('votes'));
        drawCircle();
        Menu.init();
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
    const $FIRST_TIMING = $circle.nextElementSibling;
    var drawCircle = function () {
        var children = $circle.children;
        var len = children.length;

        $circle.className += ' bloom';

        // set timing position
        $FIRST_TIMING.style.top = cw / 2 * 0.8 + 'px';

        radius = 0.4 * cw;
        coordinate.config = {
            radius: radius,
            zero: {x: cw / 2, y: cw / 2},
            total: len,
            randomPosition: true
        };
        for (var i = 0, child, c; i <= len; i++) {
            child = children[i];
            if (!child) {
                break;
            }
            c = coordinate.circle(i);
            child.style.left = (c.x - child.clientWidth / 2) + 'px';
            child.style.top = (c.y - child.clientHeight / 2) + 'px';
        }
        setTimeout(function () {
            typeIn($FIRST_TIMING, function () {
                timing[$FIRST_TIMING.dataset.timingType]();
            });
        }, 2300);
    };

    function BaseTypeInQueue() {

    }

    BaseTypeInQueue.prototype = {
        queue: [],
        add: function () {
            this.queue.push(arguments);
        },
        start: function () {
            var args = this.queue.shift();
            typeIn.call(this, args[0], args[1]);
        }
    };
    var typeInQueue = new BaseTypeInQueue();

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
        dom.style.opacity = 1;

        var progress = 1;
        var args = arguments;
        var self = this;
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
                tick = null;
                if (args[1] instanceof Function) {
                    args[1].call(timing, dom);
                }

                if (self instanceof BaseTypeInQueue && typeInQueue.queue.length) {
                    typeInQueue.start();
                }
            }
        }, 75);
    }

    const CLIENT = {width: $body.clientWidth, height: $body.clientHeight};
    const $MAP = document.querySelector('#map').parentNode;

    const $WRAPPER = document.querySelector('.wrapper');
    /* Page */
    var PageBase = function () {
        this.currentDom = document.querySelector('.wrapper>div');
        this.timeout = 550;
        var self = this;

        var endPos, startPos = {x: 0, y: 0};
        var min = CLIENT.width * 0.1;
        function moveVertically() {
            return Math.abs(endPos.x - startPos.x) < Math.abs(endPos.y - startPos.y);
        }

        addEvent($WRAPPER, 'touchstart', function (e) {
            //e.preventDefault(); // if not, Android will cause problem: touchend will not be fired
            startPos = {x: e.touches[0].clientX, y: e.touches[0].clientY};
            endPos = startPos;
        });

        addEvent($WRAPPER, 'touchmove', function (e) {
            endPos = {x: e.touches[0].clientX, y:e.touches[0].clientY};
            //if (!moveVertically()) {
                e.preventDefault();
            //}
        });

        var handler = function (e) {
            var direction;
            if (e.type == 'click') {
                return page.hasClass(this, 'right') ? page.next() : page.prev();
            } else {
                if (e.target && $MAP.contains(e.target)) {
                    return ;
                }
                var dstDom, distance = parseInt((endPos.x - startPos.x) / min);
                if (distance == 0 || moveVertically()) {
                    return ;
                } else if (distance > 0) { // to right
                    dstDom = self.currentDom.previousElementSibling;
                    direction = 'backward';
                } else if (distance < 0) { // to left
                    dstDom = self.currentDom.nextElementSibling;
                    direction = 'forward';
                }
            }

            if (dstDom instanceof HTMLElement) {
                self.flipTo(dstDom, direction);
            } else {
                self.registerTremble(self.currentDom, direction);
            }
        };
        addEvent($WRAPPER, 'touchend', handler);
        addEvent(this.arrowLeft, 'click', handler);
        addEvent(this.arrowRight, 'click', handler);
    };

    var Mask = {
        element: document.querySelector('#wrapper-mask'),
        show: function () {
            this.element.className = 'active';
        },
        hide: function () {
            this.element.className = '';
        }
    };
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
                return;
            }
            var cls = elem.className;
            cls = !cls ? className : cls + ' ' + className;
            elem.className = cls.replace(/ {2,}/, ' ');
            return this;
        },
        prev: function () {
            this.flipTo(this.currentDom.previousElementSibling, 'backward');
        },
        next: function () {
            this.flipTo(this.currentDom.nextElementSibling, 'forward');
        },
        arrowLeft: document.querySelector('.arrow.left'),
        arrowRight: document.querySelector('.arrow.right'),
        flipTo: function (to, direction) {
            if (to == this.currentDom || !to) {
                to = this.currentDom;
                return this.registerTremble(to, direction);
            }

            Mask.show(); // In case trigger flip page when flipping

            var self = this;
            if (to.id == 'love-movie' || self.currentDom.id == 'love-movie') {
                $VIDEO.className = 'hide';
                $VIDEO.pause();
            }
            if (this.currentDom.id == 'album') {
                var $pic = this.currentDom.querySelector('div');
                $pic.className = 'fade-out';
                setTimeout(function () {
                    $pic.className = '';
                }, 500);
            }
            if (to.id == 'album') {
                var $pic = to.querySelector('div');
                setTimeout(function () {
                    $pic.className = 'fade-in';
                }, 1000);
            }
            var hideClass, showClass;
            switch (direction) {
                case 'forward':
                    hideClass = 'flip-0-m90';
                    showClass = 'flip-90-0';
                    break;
                default:
                    hideClass = 'flip-0-90';
                    showClass = 'flip-m90-0';
            }
            var current = self.currentDom;

            self.addClass(current, hideClass);  // start flip-out animation
            setTimeout(function () { // remove out-animation class
                self.addClass(current, 'rotateY-90')
                    .removeClass(current, hideClass);

                self.addClass(to, showClass); // start flip-in animation
                setTimeout(function () {  // remove in-animation class
                    self.afterFlipped(to, direction, showClass);
                    if (initializer[to.dataset.init] instanceof Function) {
                        initializer[to.dataset.init](to);
                        to.dataset.init = null;
                    }
                }, self.timeout);
            }, self.timeout);
            this.currentDom = to;
        },
        afterFlipped: function (dst, direction, showClass) {
            this.removeClass(dst, 'rotateY-90').removeClass(dst, showClass);
            Mask.hide();
            this.registerArrow(dst);
            this.registerTremble(dst, direction);
        },
        registerTremble: function (dst, direction) {
            var trembleClass = direction == 'backward' ? 'anti' : '';
            var originClass = dst.className;
            dst.className = originClass + ' tremble ' + trembleClass + 'clockwise';
            Mask.show();
            setTimeout(function () {
                Mask.hide();
                dst.className = originClass;
            }, 500);
        },
        registerArrow: function (dst) {
            if (dst.nextElementSibling) {
                this.arrowRight.className = 'arrow right';
            } else {
                this.arrowRight.className = 'arrow right disabled';
            }

            if (dst.previousElementSibling) {
                this.arrowLeft.className = 'arrow left';
            } else {
                this.arrowLeft.className = 'arrow left disabled';
            }
        }
    };

    var page = new PageBase();
    /* Album */
    function BaseAlbum() {
        switch (TERMINAL) {
            case 'pc':
                this.album = document.querySelector('#album-ul');
                if (!this.album) {
                    return;
                }
                this.lis = this.album.querySelectorAll('li');
                this.imgCount = this.lis.length;
                this.timeout = 1000;
                break;
            case 'mobile':
        }
    }

    BaseAlbum.prototype = {
        downloadInterval: 100,
        img: null,
        show: function () {
            switch (TERMINAL) {
                case 'pc':
                    if (page.hasClass(this.album, 'photo-in')) {
                        return;
                    }
                    this.album.className += ' photo-in';
                    break;
                case 'mobile':
                //Wechat.previewImage();
            }
        },
        init: function () {
            switch (TERMINAL) {
                case 'pc':
                    return this._initPc();
                case 'mobile':
                    return this._initMobile();
            }

            return this;
        },
        _initMobile: function () {
            addEvent(document.querySelector('.wrapper .album .start'), 'click', function () {
                Loading.show();
                Wechat.previewImage(function () {
                    Loading.hide();
                });
            })
        },
        _initPc: function () {
            var i = 17, $this = this;
            this.img = new Image();
            function download() {
                $this.img.src = DATA.photoHost + '/' + i + '.jpg';
            }

            this.img.onload = function () {
                $this.lis[i - 1].querySelector('img').src = DATA.photoHost + '/' + i + '.jpg';
                if (--i > 0) {
                    setTimeout(download, $this.downloadInterval);
                } else {
                    this.onload = null;
                    $this.img = null;
                }
            };
            download();

            // Bind event
            for (i = 0; i < $this.imgCount; i++) {
                $this.lis[i].index = i;
                addEvent($this.lis[i], 'click', function () {
                    var elem = this;
                    elem.className = 'photo-out';
                    setTimeout(function () {
                        elem.className = 'hide';
                    }, $this.timeout);

                    if (this.index == 0) {
                        setTimeout(function () {
                            page.removeClass($this.album, 'photo-in');
                            for (var j = 0; j < $this.imgCount; j++) {
                                $this.lis[j].className = '';
                            }
                            $this.show();
                        }, $this.timeout);
                    }
                });
            }
            return this;
        }
    };
    var Album = new BaseAlbum();

    var timing = {
        diff: window.diff, // milliseconds, client - server
        zeroFill: function (num) {
            return num < 10 ? '0' + num : num;
        },
        together: function () {
            var start = 1405785600, ts, self = this;
            var valElem = $TIMING_TOGETHER.querySelectorAll('.value');
            var de = valElem[0], he = valElem[1], me = valElem[2], se = valElem[3];
            this.register(function () {
                ts = ((new Date) - self.diff) / 1000 - start;
                de.innerText = self._days(ts);
                he.innerText = self._hour(ts);
                me.innerText = self._minute(ts);
                se.innerText = self._second(ts);
            });
        },
        story: function () {
            var start = 1030809600, ts, self = this;
            var valElem = document.querySelector('#timing-love-story').querySelectorAll('.value');
            var ye = valElem[0], me = valElem[1], de = valElem[2], he = valElem[3], ie = valElem[4], se = valElem[5];

            this.register(function () {
                ts = ((new Date) - self.diff) / 1000 - start;
                ye.innerText = self._years(ts);
                me.innerText = self._month(ts);
                de.innerText = self._day(ts);
                he.innerText = self._hour(ts);
                ie.innerText = self._minute(ts);
                se.innerText = self._second(ts);
            });
        },
        marriage: function () {
            var start = 1458403200, ts, self = this;
            var valElem = document.querySelector('#timing-to-marriage').querySelectorAll('.value');
            var de = valElem[0], he = valElem[1], ie = valElem[2], se = valElem[3];

            this.register(function () {
                ts = start - ((new Date) - self.diff) / 1000;
                de.innerText = self._days(ts);
                he.innerText = self._hour(ts);
                ie.innerText = self._minute(ts);
                se.innerText = self._second(ts);
            });
        },
        _years: function (ts) { // total years
            return parseInt(ts / 86400 / 365);
        },
        _days: function (ts) { // total days
            return this.zeroFill(parseInt(ts / 86400));
        },
        _month: function (ts) {
            return this.zeroFill(parseInt(ts / 86400 % 365 / 30));
        },
        _day: function (ts) {
            return this.zeroFill(parseInt(ts / 86400 % 365));
        },
        _hour: function (ts) {
            return this.zeroFill(parseInt(ts / 3600 % 24));
        },
        _minute: function (ts) {
            return this.zeroFill(parseInt(ts / 60 % 60));
        },
        _second: function (ts) {
            return this.zeroFill(parseInt(ts % 60));
        },
        register: function (handler) {
            handler();
            setInterval(handler, 1000);
        }
    };

    function BaseMovie() {
        var bw = $body.clientWidth;
        var rate = 0.75;
        var $videoC = document.querySelector('#love-movie .video');
        $videoC.style.height = bw * rate + 'px';
        $videoC.style.marginTop = - bw * rate / 2 + 'px';
    }

    new BaseMovie();
    var BaseMenu = function () {
        this.menu = document.querySelector('#menu');
        if (!this.menu) {
            return ;
        }
        this.touch = this.menu.querySelector('#touch-us');
        this.items = this.menu.querySelector('#items');
        this.bubbleContainer = this.menu.querySelector('#bubble');
    };

    BaseMenu.prototype = {
        init: function () {
            if (!this.menu) {
                return ;
            }

            addEvent(Menu.touch, 'click', function () {
                page.hasClass(Menu.menu, 'kiss') ? Menu.hide() : Menu.show();
            });
            this.bubble();
            this.registerJs();
        },
        registerJs: function () {
            var $items = this.items.children;
            var length = $items.length;
            var $wrapper = document.querySelector('.wrapper');
            var self = this;
            for (var i = 0; i < length; i++) {
                addEvent($items[i], 'click', function () {
                    var dst = $wrapper.querySelector('.' + this.dataset.class);
                    if (!dst) {
                        return;
                    }
                    page.flipTo(dst);
                    self.hide();
                });
            }
        },
        hide: function () {
            var self = this;
            self.menu.className += ' fade';
            setTimeout(function () {
                self.menu.className = '';
                self.touch.className = 'touch-in';
            }, 500);
        },
        show: function () {
            if (page.hasClass(this.menu, 'kiss')) {
                return;
            }
            if (page.currentDom.id == 'love-movie') {
                $VIDEO.className = 'hide';
                $VIDEO.pause();
            }
            this.touch.className = '';
            this.menu.className = 'kiss';
        },
        bubble: function () {
            for (var i = 0; i < 10; i++) {
                this.bubbleContainer.appendChild(new Heart(document.createElement('canvas')));
            }
        }
    };

    var Menu = new BaseMenu();

    var Loading = {
        _: document.querySelector('#heartbeats'),
        init: function () {
            for (var i = 0; i < 3; i++) {
                this._.appendChild(new Heart(document.createElement('canvas')));
            }
        },
        show: function () {
            this._.className = 'beats';
            var self = this;
            setTimeout(function () {
                self.hide(); // In case js sdk callback does not work properly
            }, 1000)
        },
        hide: function () {
            this._.className = '';
        }
    };
    Loading.init();


    function BaseMusic() {
        this.music = document.querySelector('#music');
        this.audio = this.music.querySelector('audio');

        var self = this;
        addEvent(this.music, 'click', function () {
            self._paused() ? self.play() : self.pause();
        });

        this._paused() || this.play();  // Safari mobile cannot play music automatically
        //document.ontouchstart = function () { // touch the document to play music
        //    self._paused() || self.play();
        //    this.ontouchstart = undefined;
        //};
        var handler = function() {
            self._paused() || self.play();
            document.removeEventListener('click', handler);
        }
        document.addEventListener('click', handler);
    }

    BaseMusic.prototype = {
        init: function () {
        },
        _paused: function () {
            return 1 == localStorage.musicPaused;
        },
        play: function () {
            this.audio.play();
            this.music.className = '';
            localStorage.musicPaused = 0;
        },
        pause: function () {
            this.music.className = 'paused';
            this.audio.pause();
            localStorage.musicPaused = 1;
        }
    };
    new BaseMusic();


    const $TOUCH_US = document.querySelector('#touch-us');
    var initializer = {
        timeLine: function (elem) {
            $TOUCH_US.style.height = CLIENT.width + 'px';
            $TOUCH_US.style.bottom = (CLIENT.height - CLIENT.width) / 2 + 'px';
            $TOUCH_US.className = 'plan-b fade-in';
            setTimeout(function () {
                $TOUCH_US.parentNode.className = 'kiss';
                setTimeout(function () {
                    $TOUCH_US.parentNode.className += ' zoom-out';
                    setTimeout(function () {
                        var $anchor = document.querySelector('#time-anchors');
                        $anchor.style.display = 'block';
                    }, 1000);
                }, 600);
            }, 1000);
        },
        loveStory: function (elem) {
            var scroll = new IScroll('#love-story');

            var children = elem.querySelectorAll('.line'), len = children.length, i = 1;

            function fadeIn(elem, next) {
                var nodeType;
                elem.className += ' line-in';
                if (nodeType = elem.dataset.timingType) {
                    timing[nodeType]();
                }
                if (next && next.offsetTop > CLIENT.height) {
                    scroll.scrollToElement(next, 2000);
                }
            }
            fadeIn(children[0]);
            var tt = setInterval(function() {
                if (i < len) {
                    fadeIn(children[i], children[++i]);
                } else {
                    clearInterval(tt);
                }
            }, 2000);
        },
        typeIn: function (elem) {
            var callback, nodeType;
            new IScroll('#love-story');
            for (var i = 0, children = elem.children[0].children, len = children.length; i < len; i++) {
                if (nodeType = children[i].dataset.timingType) {
                    callback = timing[nodeType];
                } else {
                    callback = undefined;
                }
                typeInQueue.add(children[i], callback);
            }
            typeInQueue.start();
        },
        albumShow: function () {
            Album.show();
        },
        openMap: function (elem) {
            /* Baidu map */
            var map = new BMap.Map("map");
            var point = new BMap.Point(103.9207520000 , 30.6064530000);  // longitude, latitude
            map.centerAndZoom(point, 15);
            map.addOverlay(new BMap.Marker(point)); // add marker

            /* Wechat map*/
            var $button = elem.querySelector('#open-map');
            addEvent($button, 'click', function () {
                $button.className = 'active';
                setTimeout(function () {
                    $button.className = '';
                    Wechat.openLocation();
                }, 50);
            });
        },
        movie: function (elem) {
            var $start = elem.querySelector('.start');
            var handler = function () {
                $VIDEO.play();
                $VIDEO.className = '';
            };
            addEvent($start, 'click', handler);
        }
    };
}());