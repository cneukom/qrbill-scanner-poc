export default class BillDisplay {
    #container;

    constructor(container) {
        this.#container = container;
    }

    update(data) {
        this.#container.innerHTML = data;
    }
}
