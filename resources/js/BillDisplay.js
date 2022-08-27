export default class BillDisplay {
    #displayKeys = ['iban', 'creditor', 'amount', 'currency', 'debtor', 'reference', 'message'];
    #displays = {};
    #hintDisplay;
    #displayTable;

    constructor(container) {
        for (let k in this.#displayKeys) {
            let key = this.#displayKeys[k];
            this.#displays[key] = BillDisplay.#textNodeOf(container.querySelector('[data-' + key + ']'));
        }
        this.#hintDisplay = container.querySelector('[data-not-available-hint]');
        this.#displayTable = container.querySelector('[data-bill-data-table]');
    }

    static #textNodeOf(htmlElement) {
        if (htmlElement.firstChild) {
            return htmlElement.firstChild;
        }
        let textNode = document.createTextNode('');
        htmlElement.appendChild(textNode);
        return textNode;
    }

    /**
     * @param data {QRBill}
     */
    update(data) {
        if (this.#hintDisplay) {
            this.#hintDisplay.parentElement.removeChild(this.#hintDisplay);
            this.#hintDisplay = null;
        }

        this.#displayTable.className = 'table';
        for (let k in this.#displayKeys) {
            let key = this.#displayKeys[k];
            this.#displays[key].nodeValue = data[key];
        }
    }
}
