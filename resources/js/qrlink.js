var qrCode = require('qrcode');

export function init() {
    document.querySelectorAll('[data-qr-link]').forEach(function (a, b, c) {
        qrCode.toCanvas(a, a.dataset.qrLink);
    });
}
