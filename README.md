# Proof of Concept: Scan QR bills from e-banking

The introduction of the payment standard for [Swiss QR bills](https://www.paymentstandards.ch/dam/downloads/ig-qr-bill-2019-en.pdf) makes paying bills incredibly easy - in theory.
Unfortunately, many banks impose unnecessary obstacles, such as requiring mobile banking (resulting in full access to your bank accounts on your mobile phone).
While mobile banking is convenient, there may be good reasons not to use it, such as security concerns.
Hence, banks should refrain from forcing their customers to use it.

Also, not using mobile banking does not need to imply inferior experience for the end-user.
Modern browsers are capable of scanning QR bill payment slips in a straight-forward manner, without external tools, as this PoC demonstrates.

## Scan QR bills

This PoC demonstrates, that e-banking applications can offer two ways to scan QR bill payment slips, both of them easy to use:

1. Using the webcam of the computer directly - no additional software needed.
2. Using an external smartphone that is connected to your e-banking session by simply scanning another QR code - no additional apps needed.  

## Try it now

You can find this PoC running at [qrbill.poc.cneukom.ch](https://qrbill.poc.cneukom.ch).

When you want to scan a QR bill, the PoC should be self-explanatory.
Nevertheless, the following explains the two ways briefly.

### Scan a QR bill with your webcam

This option requires a webcam connected or built in to your computer.

1. [Go to the PoC](https://qrbill.poc.cneukom.ch).
2. When your browser asks whether the website can get access to your camera, allow it.
3. Hold a QR bill in front of your camera, such that the website can scan it.
4. The website will display the data encoded in the QR bill.
5. You can now use this data to make a payment in your real e-banking.

### Scan a QR bill with your smartphone

1. [Go to the PoC](https://qrbill.poc.cneukom.ch).
2. When your browser asks whether the website can get access to your camera, deny it.
3. The website should automatically switch to the smartphone tab.
If this does not happen (e.g. because you allowed the access to your camera), click on the "Smartphone" tab manually.
4. Open a QR code scanner on your mobile phone (some camera apps and mobile browsers include a QR code scanner) and point it to the QR code that is displayed by the website.
5. On your smartphone, when your mobile browser asks whether the website can get access to your camera, allow it.
6. Point your mobile phone camera to the QR bill, such that the website can scan it.
7. The smartphone will transmit the data encoded in the QR bill to the browser on your computer, which in turn will display it.
8. You can now use this data to make a payment in your real e-banking.
