var _0x6eb0 = ["host", "location", "top", "www.bejson.com", "http://www.bejson.com/", "(^|\?|&)", "=([^&]*)(\s|&|$)", "i", "test", " ", "replace", "$2", "", "toLowerCase", "true", "false", "trim", "prototype", "lTrim", "rTrim", "startWith", "^", "endWith", "$", "XMLHttpRequest", "Microsoft.XMLHTTP", "onreadystatechange", "readyState", "status", "responseText", "GET", "?", "indexOf", "&", "t=", "random", "open", "send", "Css_", "_Ver", "getItem", "localStorage", "setItem", "<style>", "</style>", "write", "script", "createElement", "text", "appendChild", "body", "Js_", "//EndSub"];
if (window[_0x6eb0[2]][_0x6eb0[1]][_0x6eb0[0]] != _0x6eb0[3]) {
    //window[_0x6eb0[2]][_0x6eb0[1]] = _0x6eb0[4]
};

function GetQueryStringRegExp(_0x4929x2, _0x4929x3) {
    var _0x4929x4 = new RegExp(_0x6eb0[5] + _0x4929x2 + _0x6eb0[6], _0x6eb0[7]);
    if (_0x4929x4[_0x6eb0[8]](_0x4929x3)) {
        return decodeURIComponent(RegExp[_0x6eb0[11]][_0x6eb0[10]](/\+/g, _0x6eb0[9]))
    };
    return _0x6eb0[12]
}

function isNumber(_0x4929x6) {
    var _0x4929x7 = /^[0-9]+.?[0-9]*$/;
    return _0x4929x7[_0x6eb0[8]](_0x4929x6)
}

function isBoolean(_0x4929x9) {
    _0x4929x9 = _0x4929x9[_0x6eb0[13]]();
    return _0x4929x9 == _0x6eb0[14] || _0x4929x9 == _0x6eb0[15]
}

function isNumberOrBoolean(_0x4929x9) {
    return isNumber(_0x4929x9) || isBoolean(_0x4929x9)
}
String[_0x6eb0[17]][_0x6eb0[16]] = function() {
    return this[_0x6eb0[10]](/(^\s*)|(\s*$)/g, _0x6eb0[12])
};
String[_0x6eb0[17]][_0x6eb0[18]] = function() {
    return this[_0x6eb0[10]](/(^\s*)/g, _0x6eb0[12])
};
String[_0x6eb0[17]][_0x6eb0[19]] = function() {
    return this[_0x6eb0[10]](/(\s*$)/g, _0x6eb0[12])
};
String[_0x6eb0[17]][_0x6eb0[20]] = function(_0x4929xb) {
    var _0x4929x4 = new RegExp(_0x6eb0[21] + _0x4929xb);
    return _0x4929x4[_0x6eb0[8]](this)
};
String[_0x6eb0[17]][_0x6eb0[22]] = function(_0x4929xb) {
    var _0x4929x4 = new RegExp(_0x4929xb + _0x6eb0[23]);
    return _0x4929x4[_0x6eb0[8]](this)
};

function GetHtml(_0x4929xd) {
    var _0x4929xe;
    var _0x4929xf;
    if (window[_0x6eb0[24]]) {
        _0x4929xf = new XMLHttpRequest()
    } else {
        _0x4929xf = new ActiveXObject(_0x6eb0[25])
    };
    _0x4929xf[_0x6eb0[26]] = function() {
        if (_0x4929xf[_0x6eb0[27]] == 4 && _0x4929xf[_0x6eb0[28]] == 200) {
            _0x4929xe = _0x4929xf[_0x6eb0[29]]
        }
    };
    _0x4929xf[_0x6eb0[36]](_0x6eb0[30], _0x4929xd + (_0x4929xd[_0x6eb0[32]](_0x6eb0[31]) > -1 ? _0x6eb0[33] : _0x6eb0[31]) + _0x6eb0[34] + Math[_0x6eb0[35]](), false);
    _0x4929xf[_0x6eb0[37]]();
    return _0x4929xe
}

function GetCss(_0x4929xd, _0x4929x11, _0x4929x12) {
    var _0x4929x13, _0x4929x14;
    _0x4929x13 = _0x6eb0[38] + _0x4929x11;
    _0x4929x14 = _0x4929x13 + _0x6eb0[39];
    if (!window[_0x6eb0[41]][_0x6eb0[40]](_0x4929x13) || parseInt(window[_0x6eb0[41]][_0x6eb0[40]](_0x4929x14)) < _0x4929x12) {
        window[_0x6eb0[41]][_0x6eb0[42]](_0x4929x13, GetHtml(_0x4929xd));
        window[_0x6eb0[41]][_0x6eb0[42]](_0x4929x14, _0x4929x12)
    };
    document[_0x6eb0[45]](_0x6eb0[43] + window[_0x6eb0[41]][_0x6eb0[40]](_0x4929x13) + _0x6eb0[44])
}

function SetJS(_0x4929x16) {
    var _0x4929x17 = document[_0x6eb0[47]](_0x6eb0[46]);
    _0x4929x17[_0x6eb0[48]] = _0x4929x16;
    document[_0x6eb0[50]][_0x6eb0[49]](_0x4929x17)
}

function GetJs(_0x4929xd, _0x4929x11, _0x4929x12) {
    var _0x4929x13, _0x4929x14;
    _0x4929x13 = _0x6eb0[51] + _0x4929x11;
    _0x4929x14 = _0x4929x13 + _0x6eb0[39];
    if (!window[_0x6eb0[41]][_0x6eb0[40]](_0x4929x13) || parseInt(window[_0x6eb0[41]][_0x6eb0[40]](_0x4929x14)) < _0x4929x12) {
        var _0x4929x19 = GetHtml(_0x4929xd);
        window[_0x6eb0[41]][_0x6eb0[42]](_0x4929x13, _0x4929x19);
        if (_0x4929x19[_0x6eb0[32]](_0x6eb0[52]) > -1) {
            window[_0x6eb0[41]][_0x6eb0[42]](_0x4929x14, _0x4929x12)
        }
    };
    SetJS(window[_0x6eb0[41]][_0x6eb0[40]](_0x4929x13))
}