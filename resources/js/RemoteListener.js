export default class RemoteListener {
    /** @type {BillDisplay} */
    #billDisplay;
    /** @type {String} */
    #pollUrl;
    /** @type {ToastFactory} */
    #toastFactory;

    /**
     *
     * @param billDisplay {BillDisplay}
     * @param pollUrl {String}
     * @param toastFactory {ToastFactory}
     */
    constructor(billDisplay, pollUrl, toastFactory) {
        this.#billDisplay = billDisplay;
        this.#pollUrl = pollUrl;
        this.#toastFactory = toastFactory;
        this.poll();
    }

    poll() {
        axios.get(this.#pollUrl)
            .then((result) => {
                switch(result.data.type) {
                    case 'device':
                        this.#toastFactory.createSimpleSuccessToast('New smartphone registered');
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
