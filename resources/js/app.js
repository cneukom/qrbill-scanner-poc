require('./bootstrap');
import bootstrap from 'bootstrap';

var qrLink = require('./qrlink');

addEventListener('load', function () {
    qrLink.init();
});
