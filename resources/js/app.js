import RemoteListener from "./RemoteListener";

require('./bootstrap');
require('./String');
import bootstrap from 'bootstrap';
import BillDisplay from './BillDisplay';
import RemoteDisplay from './RemoteDisplay';
import Scanner from './Scanner';
import ToastFactory from "./ToastFactory";
import CameraErrorHandler from "./CameraErrorHandler";

let qrLink = require('./qrlink');

addEventListener('load', function () {
    qrLink.init();

    const toastFactory = new ToastFactory(document.querySelector('[data-toast-container]'));
    const container = document.querySelector('[data-preview]');
    if (container) {
        const fallbackTab = document.querySelector('[data-show-on-cameradenied]');
        const cameraErrorHandler = new CameraErrorHandler(container, toastFactory, fallbackTab);
        let display = document.querySelector('[data-bill-display-poll]');
        if (display) {
            const billDisplay = new BillDisplay(display, toastFactory);
            new Scanner(container, billDisplay, toastFactory, cameraErrorHandler).init();
            new RemoteListener(billDisplay, display.dataset.billDisplayPoll, toastFactory);
        } else {
            display = document.querySelector('[data-remote-display-url]');
            if (display) {
                const remoteDisplay = new RemoteDisplay(display.dataset.remoteDisplayUrl, toastFactory);
                new Scanner(container, remoteDisplay, toastFactory, cameraErrorHandler).init();
            }
        }
    }
});
