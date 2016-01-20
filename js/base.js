/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * image size 414x736, ~130kb
 *
 */
+(function () {
    function isHorizon() {
        return window.orientation !== undefined && window.orientation !== 0;
    }

    window.onresize = function () {
        location.reload();
    };

    if (isHorizon()) {
        return alert('Please place your phone vertically.');
    }

    function addEvent(elem, eventName, callback) {
        if (TERMINAL == 'pc') {
            elem['onclick'] = callback;
        } else {
            elem['on' + eventName] = callback;
        }
    }

    const $_TIMING = document.querySelector('#timing-being-together');

    var Wechat = {
        wechat: wx,
        init: function () {
            //DATA.config.debug = true;
            DATA.config.jsApiList = ['previewImage', 'openLocation'];
            this.wechat.config(DATA.config);
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
                latitude: 30.6001688195,
                longitude: 103.9143360720,
                name: '双流聚竹园酒楼',
                address: '双流县其他航空路西段2号近紫荆电影院,聚竹园酒楼双流示范店 (028)85736222',
                scale: 20, // 1~28,
                infoUrl: 'abc'
            };
            this.wechat.openLocation(config);
        }
    };
    Wechat.init();

    var $body = document.body;
    $body.onload = function () {
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
    var drawCircle = function () {
        var children = $circle.children;
        var len = children.length;

        $circle.className += ' bloom';

        // set timing position
        $_TIMING.style.top = cw / 2 * 0.8 + 'px';

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
            typeIn($_TIMING, function () {
                timing.together();
            });
        }, 2300);
    };

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
                    args[1](dom);
                }
            }
        }, 75);
    }

    /* Page */
    var PageBase = function () {
        this.currentDom = document.querySelector('.wrapper>div');
        this.timeout = 600;
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
            var current = this.currentDom;
            var prev = current.previousElementSibling;
            if (!prev) {
                return;
            }

            this.flipTo(prev);
        },
        next: function () {
            var current = this.currentDom;
            var next = current.nextElementSibling;
            if (!next) {
                return;
            }

            this.flipTo(next);
        },
        flipTo: function (to) {
            var $this = this;
            var current = $this.currentDom;

            $this.addClass(current, 'flip-0-90');
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
            addEvent(document.querySelector('.wrapper .album > img'), 'touchstart', function () {
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
                $this.img.src = '../images/photos/' + i + '.jpg';
            }

            this.img.onload = function () {
                $this.lis[i - 1].querySelector('img').src = '../images/photos/' + i + '.jpg';
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
                addEvent($this.lis[i], 'touchstart', function () {
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

    var initializer = {
        typeIn: function (elem) {
            typeIn(elem.children[0], function () {
                timing.story();
            });
        },
        albumShow: function () {
            Album.show();
        },
        openMap: function () {
            Wechat.openLocation();
        }
    };

    var timing = {
        diff: window.diff, // milliseconds, client - server
        zeroFill: function (num) {
            return num < 10 ? '0' + num : num;
        },
        together: function () {
            var start = 1405785600;
            var valElem = $_TIMING.querySelectorAll('.value');
            var de = valElem[0], he = valElem[1], me = valElem[2], se = valElem[3];
            var ts, d, h, m, s;
            var self = this;
            this.register(function () {
                ts = ((new Date) - self.diff) / 1000 - start;
                d = parseInt(ts / 86400);
                h = parseInt(ts / 3600 % 24);
                m = parseInt(ts / 60 % 60);
                s = parseInt(ts % 60);
                de.innerText = self.zeroFill(d);
                he.innerText = self.zeroFill(h);
                me.innerText = self.zeroFill(m);
                se.innerText = self.zeroFill(s);
            });
        },
        story: function () {
            var start = 1030809600;
            var valElem = document.querySelector('#timing-love-story').querySelectorAll('.value');
            var ye = valElem[0], me = valElem[1], de = valElem[2];
            var ts, y, m, d;
            var self = this;

            var time = function () {
                ts = ((new Date) - self.diff) / 1000 - start;
                y = parseInt(ts / 86400 / 365);
                m = parseInt(ts / 86400 % 365 / 30);
                d = parseInt(ts / 86400 % 365 % 30);
                ye.innerText = y;
                me.innerText = self.zeroFill(m);
                de.innerText = self.zeroFill(d);
            };
            time();
        },
        register: function (handler) {
            handler();
            setInterval(handler, 1000);
        }
    };

    var BaseMenu = function () {
        this.menu = document.querySelector('#menu');
        this.touch = this.menu.querySelector('#touch-us');
        this.items = this.menu.querySelector('#items');
        this.bubbleContainer = this.menu.querySelector('#bubble');
    };

    BaseMenu.prototype = {
        currentIndex: 0, // current page
        init: function () {
            this.bubble();
            this.registerJs();
        },
        registerJs: function () {
            var $items = this.items.children;
            var length = $items.length;
            var $wrapper = document.querySelector('.wrapper');
            var self = this;
            for (var i = 0; i < length; i++) {
                $items[i].index = i;
                addEvent($items[i], 'touchstart', function () {
                    if (self.currentIndex == this.index) {
                        return self.hide();
                    }
                    var dest = $wrapper.querySelector('.' + this.dataset.class);
                    if (!dest) {
                        return ;
                    }
                    self.currentIndex = this.index;
                    page.flipTo(dest);
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
            this.touch.className = '';
            this.menu.className = 'kiss';
        },
        bubble: function () {
            for (var i = 0; i < 10 ; i++) {
                this.bubbleContainer.appendChild(new Heart(document.createElement('canvas')));
            }
        }
    };

    var Menu = new BaseMenu();
    addEvent(Menu.touch, 'touchstart', function () {
        page.hasClass(Menu.menu, 'kiss') ? Menu.hide() : Menu.show();
    });

    window.Menu = Menu;

    window.page = page;

    window.timing = timing;

    var Heart = function (canvas) {
        return this.draw(canvas);
    };
    Heart.prototype = {
        radius: 0,
        zero: {},
        radian: Math.PI,
        radianIncrement: Math.PI / 30 * 2,
        context: null,
        maxRadian: 3 * Math.PI,
        strokeStyle: '#FF9191',
        size: 100,
        coordinate: function () {
            var radian = this.radian;
            var x = this.zero.x + this.radius * (16 * Math.pow(Math.sin(radian), 3));
            var y = this.zero.y - this.radius * (13 * Math.cos(radian) - 5 * Math.cos(2 * radian) - 2 * Math.cos(3 * radian) - Math.cos(4 * radian));

            this.radian += this.radianIncrement;

            return {x: x, y: y};
        },
        draw: function (canvas) {
            this.context = canvas.getContext('2d');
            this.context.beginPath();
            this.context.strokeStyle = this.strokeStyle;
            this.context.lineWidth = 2;

            canvas.width = this.size;
            canvas.height = this.size;
            this.zero = {x: this.size / 2, y: this.size / 2};
            this.radius = this.size / 40;

            var initCoordinate = this.coordinate();
            this.context.moveTo(initCoordinate.x, initCoordinate.y);

            while (this.radian < this.maxRadian) {
                this.registerLine();
            }
            this.context.fillStyle = this.strokeStyle;
            this.context.fill();
            return canvas;
        },
        registerLine: function () {
            var c = this.coordinate();
            this.context.lineTo(c.x, c.y);
            this.context.strokeStyle = this.strokeStyle;
            this.context.stroke();
        }
    };

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

    function BaseMusic () {
        this.music = document.querySelector('#music');
        this.audio = this.music.querySelector('audio');
    }
    BaseMusic.prototype = {
        init: function () {
            this._paused() || this.play();
            var self = this;
            addEvent(this.music, 'touchstart', function () {
                self._paused() ? self.play() : self.pause();
            });
        },
        _paused: function () {
            return 1 == localStorage.musicPaused;
        },
        play: function () {
            this.music.className = '';
            this.audio.play();
            localStorage.musicPaused = 0;
        },
        pause: function () {
            this.music.className = 'paused';
            this.audio.pause();
            localStorage.musicPaused = 1;
        }
    };
    var Music = new BaseMusic();
    Music.init();
    window.Music = Music;
}());