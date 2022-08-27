// Minimalistic implementation respecting https://www.paymentstandards.ch/dam/downloads/ig-qr-bill-en.pdf
// Only the values used are implemented.

export default class QRBill {
    constructor(content) {
        let lines = content.split(/\r?\n/);
        if (lines[0] !== 'SPC' || lines[30] !== 'EPD') {
            throw "Not a QR bill";
        }
        if (lines[1] !== '0200') {
            throw "QR bill version not supported";
        }
        this.iban = lines[3].replace(/(.{1,4})/g, '$1 ').trim();
        this.creditor = this.#parseAddress(lines, 4);
        this.amount = lines[18];
        this.currency = lines[19];
        this.debtor = this.#parseAddress(lines, 20);
        this.reference = lines[28].reverse().replace(/(.{1,5})/g, '$1 ').trim().reverse();
        this.message = lines[29];
    }

    #parseAddress(lines, offset) {
        let creditor = lines[offset + 1] + '\n';
        switch (lines[offset]) {
            case 'S':
                creditor += lines[offset + 2] + ' ' + lines[offset + 3] + '\n';
                creditor += lines[offset + 6] + ' – ' + lines[offset + 4] + ' ' + lines[offset + 5];
                break;
            case 'K':
                creditor += lines[offset + 2] + '\n';
                creditor += lines[offset + 3];
                break;
            default:
                throw "QR Bill contains illegal address type";
        }
        return creditor;
    }
}
