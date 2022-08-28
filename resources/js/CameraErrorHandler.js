import {Tab} from "bootstrap";

export default class CameraErrorHandler {
    /** @var {HTMLElement} */
    #previewContainer;
    /** @var {ToastFactory} */
    #toastFactory;
    /** @var {HTMLElement} */
    #fallbackTab;

    /**
     * @param previewContainer {HTMLElement}
     * @param toastFactory {ToastFactory}
     * @param fallbackTab {HTMLElement}
     */
    constructor(previewContainer, toastFactory, fallbackTab) {
        this.#previewContainer = previewContainer;
        this.#toastFactory = toastFactory;
        this.#fallbackTab = fallbackTab;
    }

    #constructMessage(message) {
        if (this.#fallbackTab) {
            message += ' Please try scanning using a smartphone.';
        }
        return message;
    }

    #triggerErrorMessage(message) {
        this.#previewContainer.innerHTML = '<div class="alert alert-danger">' + message + '</div>';
        if (this.#fallbackTab) {
            this.#toastFactory.createSimpleWarningToast(message);
            Tab.getOrCreateInstance(this.#fallbackTab).show();

        }
    }

    triggerAccessDenied() {
        this.#triggerErrorMessage(
            this.#constructMessage('Access to camera denied.'),
        );
    }

    triggerNoCamera() {
        this.#triggerErrorMessage(
            this.#constructMessage('No camera found.'),
        );
    }
}
