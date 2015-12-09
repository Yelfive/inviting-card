/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 * @version 0.0.1
 */
window.log = function (msg) {
    console.log(msg);
}
fk = function (selector) {
    if (window === this) {
        return new fk(selector);
    } else if (!selector) {
        return false;
    }
    if (selector instanceof Function) { // document ready

    }
    var doms;
    if (selector.indexOf('#') === 0) {
        var id = selector.substr(1);
        doms = [document.getElementById(id)];
    } else if (selector.indexOf('.') === 0) {
        var className = selector.substr(1);
        doms = document.getElementsByClassName(className);
    } else {
        doms = document.getElementsByTagName(selector);
    }

    var domArray = [];
    for(var i=0; i<doms.length; i++){
        domArray.push(doms.item(i));
    }
    [].push.apply(this, domArray);
    return this;
}

fk.each = function (data, callback) {
    if (typeof callback !== 'function') {
        return log('Invalid callback for each');
    } else if (!data) {
        return false;
    }
    if (data instanceof Array || data instanceof HTMLCollection || data instanceof fk) {
        for (var i = 0; i < data.length; i++) {
            callback(i, data[i]);
        }
    } else {
        for (var i in data) {
            callback(i, data[i]);
        }
    }
};

fk.prototype = {
    resize: function () {
        alert('hahaha');
    },
    css: function (style, property) {
        if (style instanceof Object) {
            var $fk = this;
            fk.each(style, function (k, v) {
                $fk.css(k,v);
            });
            return this;
        }
        var styleArray = style.split('-');
        var camel = styleArray.shift();
        fk.each(styleArray, function (k, v) {
            var firstLetter = v.substr(0,1);
            camel += v.replace(firstLetter, firstLetter.toUpperCase());
        });
        fk.each(this, function (k, v) {
            v.style[camel] = property;
        });
        return this;
    },
    append: function (content) {
        if (content instanceof fk) {
            //
        }
        var $fk = fk;
        fk.each();
    },
    get: function (index) {
        return this[index];
    }
};