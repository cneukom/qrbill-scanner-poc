export default class RemoteDisplay {
    /** @type {String} */
    #url;
    /** @type {ToastFactory} */
    #toastFactory;

    /**
     * @param url {String}
     * @param toastFactory {ToastFactory}
     */
    constructor(url, toastFactory) {
        this.#url = url;
        this.#toastFactory = toastFactory;
    }


    /**
     * @param data {QRBill}
     */
    update(data) {
        axios.post(this.#url, {
            content: data,
        })
            .then(() => this.#toastFactory.createSimpleSuccessToast('Successfully scanned a bill'))
            .catch(() => this.#toastFactory.createSimpleErrorToast('Failed to send bill data to server'));
    }
}
