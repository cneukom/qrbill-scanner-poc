export default class RemoteListener {
    /** @type {BillDisplay} */
    #billDisplay;
    /** @type {String} */
    #pollUrl;

    /**
     *
     * @param billDisplay {BillDisplay}
     * @param pollUrl {String}
     */
    constructor(billDisplay, pollUrl) {
        this.#billDisplay = billDisplay;
        this.#pollUrl = pollUrl;
        this.poll();
    }

    poll() {
        axios.get(this.#pollUrl)
            .then((result) => {
                switch(result.data.type) {
                    case 'device':
                        console.log('new scanner registered');
                        break;
                    case 'scan':
                        this.#billDisplay.update(result.data.data.content);
                        break;
                }
            })
            .catch()
            .then(() => this.poll());
    }
}
