import {Toast} from 'bootstrap';

export default class ToastFactory {
    /** @type {HTMLElement} */
    #toastContainer;

    /**
     * @param toastContainer {HTMLElement}
     */
    constructor(toastContainer) {
        if (!toastContainer) {
            throw 'toastContainer must be set';
        }
        this.#toastContainer = toastContainer;
    }

    createSimpleSuccessToast(message) {
        this.createSimpleToast(message, 'bg-success text-white');
    }

    createSimpleErrorToast(message) {
        this.createSimpleToast(message, 'bg-danger text-white');
    }

    createSimpleWarningToast(message) {
        this.createSimpleToast(message, 'bg-warning');
    }

    createSimpleToast(message, classNames) {
        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center m-3 ' + classNames;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        toastEl.addEventListener('hidden.bs.toast', function() {
            this.parentNode.removeChild(this);
        });
        this.#toastContainer.appendChild(toastEl);

        const toastContent = document.createElement('div');
        toastContent.className = 'd-flex';
        toastEl.appendChild(toastContent);

        const toastBody = document.createElement('div');
        toastBody.className = 'toast-body';
        toastContent.appendChild(toastBody);

        const toastMessage = document.createTextNode(message);
        toastBody.appendChild(toastMessage);

        const closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.className = 'btn-close me-2 m-auto';
        closeButton.dataset.bsDismiss = 'toast';
        closeButton.setAttribute('aria-label', 'Close');
        toastContent.appendChild(closeButton);

        const toast = new Toast(toastEl);
        toast.show();
    }
}
