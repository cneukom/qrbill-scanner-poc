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
        this.creditor = lines[5];
        this.amount = lines[18];
        this.currency = lines[19];
        this.debtor = lines[21];
        this.reference = lines[28];
        this.message = lines[29];
    }
}
