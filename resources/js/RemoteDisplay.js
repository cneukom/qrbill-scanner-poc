export default class RemoteDisplay {
    #url;

    constructor(url) {
        this.#url = url;
    }


    /**
     * @param data {QRBill}
     */
    update(data) {
        axios.post(this.#url, {
            content: data,
        });
    }
}
