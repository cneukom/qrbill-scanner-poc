export default class RemoteDisplay {
    #url;

    constructor(url) {
        this.#url = url;
    }

    update(data) {
        axios.post(this.#url, {
            content: data,
        });
    }
}
