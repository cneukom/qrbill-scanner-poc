export default class Copiable {
    static #disabled = false;
    /** @var {HTMLElement} */
    #textContainer;
    /** @var {HTMLElement} */
    #button;
    /** @var {ToastFactory} */
    #toastFactory;

    /**
     * @param textContainer {HTMLElement}
     * @param controlContainer {HTMLElement}
     * @param toastFactory {ToastFactory}
     * @param [className] {string}
     */
    constructor(textContainer, controlContainer, toastFactory, className) {
        this.#textContainer = textContainer;
        this.#createButton(className);
        this.#toastFactory = toastFactory;
        controlContainer.prepend(this.#button);
    }

    #createButton(className) {
        this.#button = document.createElement('a');
        this.#button.className = 'copy-button default ' + (className ?? '');
        this.#button.addEventListener('pointerup', () => this.#copy());
        this.#addIcon('clipboard', 'default');
        this.#addIcon('clipboard-check', 'success');
        this.#addIcon('clipboard-x', 'error');
        this.#addIcon('clipboard-minus', 'disabled');
    }

    #addIcon(iconName, className) {
        const defaultIcon = document.createElement('i');
        defaultIcon.className = 'bi-' + iconName + ' ' + className;
        this.#button.appendChild(defaultIcon);
    }

    #copy() {
        if (Copiable.#disabled) {
            return;
        }

        if ('clipboard' in navigator && 'writeText' in navigator.clipboard) {
            navigator.clipboard.writeText(this.#textContainer.textContent).then(
                () => {
                    this.#button.classList.add('success');
                    setTimeout(() => this.#button.classList.remove('success'), 600);
                },
                () => this.#handleCopyError('Access to clipboard was denied'),
            );
        } else {
            this.#handleCopyError('Access to clipboard is not supported by your browser');
        }
    }

    #handleCopyError(errorMessage) {
        this.#button.classList.replace('default', 'error');
        this.#toastFactory.createSimpleErrorToast(errorMessage);
        Copiable.#disabled = true;

        setTimeout(() => {
            this.#button.classList.remove('error');
            document.body.classList.add('copiable-disabled');
        }, 600);
    }
}
