import RemoteListener from "./RemoteListener";

require('./bootstrap');
import bootstrap from 'bootstrap';
import BillDisplay from './BillDisplay';
import RemoteDisplay from './RemoteDisplay';
import Scanner from './Scanner';

let qrLink = require('./qrlink');

addEventListener('load', function () {
    qrLink.init();

    let container = document.querySelector('[data-preview]');
    if (container) {
        let display = document.querySelector('[data-bill-display-poll]');
        if (display) {
            let billDisplay = new BillDisplay(display);
            new Scanner(container, billDisplay).init();
            new RemoteListener(billDisplay, display.dataset.billDisplayPoll);
        } else {
            display = document.querySelector('[data-remote-display-url]');
            if (display) {
                new Scanner(container, new RemoteDisplay(display.dataset.remoteDisplayUrl)).init();
            }
        }
    }
});
