
/**
 * Defines a color from text MD5
 * @param {string} text
 * @returns {String} RGB color, like #FFFFFF
 */
function setColorFromText(text) {
    var nbr = 7;
    var from = 70;
    var to = 320;
    var md5 = MD5(text);
    var m = parseInt(md5, 16) % nbr;
    var c = {
        h: from + ((to - from) * m / nbr),
        l: 0.47,
        s: 0.86
    };
    return hslToRGB(c);
}

/**
 * Change Hue.
 * @param {string} rgb color, like #FFFFFF
 * @param {integer} degree, between 0 and 360
 * @returns {String} rgb color, like #FFFFFF
 */
function changeHue(rgb, degree) {
    var hsl = rgbToHSL(rgb);
    hsl.h += degree;
    if (hsl.h > 360) {
        hsl.h -= 360;
    } else if (hsl.h < 0) {
        hsl.h += 360;
    }
    return hslToRGB(hsl);
}

/**
 * Converts RGB (Red, Green, Blue) to HSL (Hue, Saturation, Light).
 * @param {string} rgb code, like #FFFFFF
 * @returns {structured} HSL datas
 */
function rgbToHSL(rgb) {
    // strip the leading # if it's there
    rgb = rgb.replace(/^\s*#|\s*$/g, '');
    // convert 3 char codes --> 6, e.g. `E0F` --> `EE00FF`
    if (rgb.length == 3) {
        rgb = rgb.replace(/(.)/g, '$1$1');
    }

    var r = parseInt(rgb.substr(0, 2), 16) / 255,
            g = parseInt(rgb.substr(2, 2), 16) / 255,
            b = parseInt(rgb.substr(4, 2), 16) / 255,
            cMax = Math.max(r, g, b),
            cMin = Math.min(r, g, b),
            delta = cMax - cMin,
            l = (cMax + cMin) / 2,
            h = 0,
            s = 0;
    if (delta == 0) {
        h = 0;
    } else if (cMax == r) {
        h = 60 * (((g - b) / delta) % 6);
    } else if (cMax == g) {
        h = 60 * (((b - r) / delta) + 2);
    } else {
        h = 60 * (((r - g) / delta) + 4);
    }

    if (delta == 0) {
        s = 0;
    } else {
        s = (delta / (1 - Math.abs(2 * l - 1)));
    }

    return {
        h: h,
        s: s,
        l: l
    };
}

/**
 * Converts HSL (Hue, Saturation, Light) to RGB (Red, Green, Blue).
 * Some calculations, like s, c & m, are not explainable.
 * @param {structured} hsl, with parameters H, S & L
 * @returns {String} RGB code
 */
function hslToRGB(hsl) {
    var h = hsl.h,
            s = hsl.s,
            l = hsl.l,
            c = (1 - Math.abs(2 * l - 1)) * s,
            x = c * (1 - Math.abs((h / 60) % 2 - 1)),
            m = l - c / 2,
            r, g, b;
    if (h < 60) {
        r = c;
        g = x;
        b = 0;
    } else if (h < 120) {
        r = x;
        g = c;
        b = 0;
    } else if (h < 180) {
        r = 0;
        g = c;
        b = x;
    } else if (h < 240) {
        r = 0;
        g = x;
        b = c;
    } else if (h < 300) {
        r = x;
        g = 0;
        b = c;
    } else {
        r = c;
        g = 0;
        b = x;
    }

    r = normalize_rgb_value(r, m);
    g = normalize_rgb_value(g, m);
    b = normalize_rgb_value(b, m);
    return rgbToHex(r, g, b);
}

/**
 * Sets correct color value, from 0 to 255
 * @param {integer} color value
 * @param {integer} m
 * @returns {Number} corrected color value
 */
function normalize_rgb_value(color, m) {
    color = Math.floor((color + m) * 255);
    if (color < 0) {
        color = 0;
    }
    return color;
}

/**
 * Converts RGB code to HEX value
 * @param {type} r : red value, from 0 to 255
 * @param {type} g : green value, from 0 to 255
 * @param {type} b : blue value, from 0 to 255
 * @returns {String} Hex color
 */
function rgbToHex(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
}

/**
 * Change color data to white (camaieu), 
 * changing light information,
 * according to index
 * @param {string} hexColor
 * @param {integer} index
 * @returns {String}
 */
function desaturate(hexColor, index) {
    var hsl = rgbToHSL(hexColor);
    hsl.l = hsl.l + (1 - hsl.l) * index / (index + 2);
    return hslToRGB(hsl);
}