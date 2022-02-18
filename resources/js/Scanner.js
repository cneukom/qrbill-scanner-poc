import {BrowserQRCodeReader} from "@zxing/browser";

export default class Scanner {
    #previewContainer;
    #deviceChooser;
    #video;
    #display;
    #controls;

    constructor(previewContainer, display) {
        this.#previewContainer = previewContainer;
        this.#deviceChooser = previewContainer.querySelector('select');
        this.#video = previewContainer.querySelector('video');
        this.#display = display;

        if (!this.#deviceChooser || !this.#video) {
            throw "previewContainer must contain a select and a video element";
        }
        this.#deviceChooser.addEventListener('change', () => this.scan(this.#deviceChooser.value));
    }

    async init() {
        let devices;
        try {
            devices = await BrowserQRCodeReader.listVideoInputDevices();
        } catch(e) {
            this.#previewContainer.innerHTML = '<div class="alert alert-danger">'+e+'</div>';
        }
        if (devices.length === 0) {
            this.#previewContainer.innerHTML = '<div class="alert alert-warning">No cameras found. Please try the Smartphone PoC.</div>';
        } else {
            for (let i = 0; i < devices.length; i++) {
                let option = document.createElement('option');
                option.value = devices[i].deviceId;
                option.text = devices[i].label;
                this.#deviceChooser.appendChild(option);
            }

            await this.scan(this.#deviceChooser.value);
        }
    }

    async scan(deviceId) {
        if (this.#controls) {
            this.#controls.stop();
        }

        this.#controls = await new BrowserQRCodeReader().decodeFromVideoDevice(deviceId, this.#video, (result) => {
            if (result) {
                this.#display.update(result.text);
            }
        });
    }
}
