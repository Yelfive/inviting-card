/**
 * @author Felix Huang <yelfivehuang@gmail.com>
 */
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
    fk.each(doms, function (k, v) {
        domArray.push(v);
    });
    [].push.apply(this, domArray);
    return this;
}

fk.each = function (data, callback) {
    if (typeof callback !== 'function') {
        return log('Invalid callback for each');
    }
    if (data instanceof Array || data instanceof HTMLCollection) {
        for (var i = 0; i< data.length; i++) {
            callback(i, data[i]);
        }
    } else {
        for (var i in data) {
            callback(i, data[i]);
        }
    }
};

window.log = function (msg) {
    console.log(msg);
}

