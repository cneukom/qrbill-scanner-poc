import {BrowserQRCodeReader} from "@zxing/browser";
import QRBill from "./QRBill";

export default class Scanner {
    /** @type {HTMLElement} */
    #previewContainer;
    /** @type {HTMLElement} */
    #display;
    /** @type {ToastFactory} */
    #toastFactory;
    /** @type {CameraErrorHandler} */
    #cameraErrorHandler;
    #deviceChooser;
    #video;
    #controls;
    #recentBillData;

    /**
     * @param previewContainer {HTMLElement}
     * @param display {HTMLElement}
     * @param toastFactory {ToastFactory}
     * @param cameraErrorHandler {CameraErrorHandler}
     */
    constructor(previewContainer, display, toastFactory, cameraErrorHandler) {
        this.#previewContainer = previewContainer;
        this.#deviceChooser = previewContainer.querySelector('select');
        this.#video = previewContainer.querySelector('video');
        this.#display = display;
        this.#toastFactory = toastFactory;
        this.#cameraErrorHandler = cameraErrorHandler;

        if (!this.#deviceChooser || !this.#video) {
            throw "previewContainer must contain a select and a video element";
        }
        this.#deviceChooser.addEventListener('change', () => this.#scanFromVideoDevice(this.#deviceChooser.value));
    }

    async init() {
        let devices, selectedDeviceId, stream;
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'environment',
                },
            });
            selectedDeviceId = stream.getVideoTracks()[0].getSettings().deviceId;
            devices = await BrowserQRCodeReader.listVideoInputDevices();
        } catch (error) {
            if (typeof error === 'string') {
                this.#previewContainer.innerHTML = '<div class="alert alert-danger">' + error + '</div>';
            } else {
                console.error(error);
                this.#cameraErrorHandler.triggerAccessDenied();
            }
            return;
        }
        if (devices.length === 0) {
            this.#cameraErrorHandler.triggerNoCamera();
        } else {
            this.#updateDeviceChooser(devices, selectedDeviceId);
            await this.#scanFromStream(stream);
        }
    }

    #updateDeviceChooser(devices, selectedDeviceId) {
        for (let i = 0; i < devices.length; i++) {
            let option = document.createElement('option');
            option.value = devices[i].deviceId;
            option.text = devices[i].label;
            if (option.value === selectedDeviceId) {
                option.selected = true;
            }
            this.#deviceChooser.appendChild(option);
        }
    }

    async #scanFromStream(stream) {
        if (this.#controls) {
            this.#controls.stop();
        }

        this.#controls = await new BrowserQRCodeReader().decodeFromStream(stream, this.#video, this.#scanCallback());
    }

    async #scanFromVideoDevice(deviceId) {
        if (this.#controls) {
            this.#controls.stop();
        }

        this.#controls = await new BrowserQRCodeReader().decodeFromVideoDevice(deviceId, this.#video, this.#scanCallback());
    }

    #scanCallback() {
        return (result) => {
            if (result) {
                this.#updateDisplay(result.getText());
            }
        }
    }

    #updateDisplay(data) {
        if (this.#recentBillData === data) {
            return;
        }
        try {
            let bill = new QRBill(data);
            this.#display.update(bill);
            this.#recentBillData = data;
            setTimeout(() => this.#recentBillData = null, 5000);
        } catch (error) {
            if (typeof error === 'string') {
                this.#toastFactory.createSimpleErrorToast(error);
            } else {
                console.error(error);
            }
        }
    }
}
