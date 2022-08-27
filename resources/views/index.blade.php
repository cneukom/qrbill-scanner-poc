<x-root>
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-body">
                <h1 class="mb-4">Scan QR Bills in your browser</h1>
                <p class="lead fst-italic text-muted mb-4">
                    This page demonstrates that modern web browsers are capable of scanning QR bills without installing
                    dedicated software on your computer and/or mobile phone.
                </p>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <h4>Scan a QR bill</h4>
                        <p>In order to scan a QR bill, you have the following options:</p>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-webcam-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-webcam" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">
                                    Webcam
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-smartphone-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-smartphone" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">
                                    Smartphone
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-webcam" role="tabpanel"
                                 aria-labelledby="pills-webcam-tab">
                                <div data-preview>
                                    <label for="camera-chooser" class="d-none">Choose camera</label>
                                    <select class="form-select" id="camera-chooser"></select>
                                    <video class="mt-3"></video>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-smartphone" role="tabpanel"
                                 aria-labelledby="pills-smartphone-tab">
                                <p>Scan this QR code with your mobile phone. Hint: some native camera apps and mobile
                                    browsers (e.g. Firefox Mobile) come with an integrated QR code scanner.</p>
                                <canvas data-qr-link="{{ route('registerScanner', [$token]) }}"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <h4>Check the QR bill data</h4>
                        <div data-bill-display-poll="{{ route('listen') }}">
                            <div data-not-available-hint class="alert alert-info">Please scan a QR bill.</div>
                            <table data-bill-data-table class="table d-none">
                                <tr>
                                    <th>IBAN</th>
                                    <td data-iban></td>
                                </tr>
                                <tr>
                                    <th>Creditor</th>
                                    <td data-creditor class="text-pre-wrap"></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>
                                        <span data-amount></span>
                                        <span data-currency></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Debtor</th>
                                    <td data-debtor class="text-pre-wrap"></td>
                                </tr>
                                <tr>
                                    <th>Reference</th>
                                    <td data-reference></td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td data-message></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="post" class="mt-4">
                    @csrf
                    To deregister your smartphones, you can always
                    <a href="javascript:" onclick="this.parentNode.submit()">start a new session</a>
                </form>
            </div>
        </div>
        <div data-toast-container class="position-absolute top-0 end-0"></div>
        <p class="mt-3 text-center">A Proof of Concept by <a href="https://cneukom.ch">Cédric Neukom</a></p>
    </div>
</x-root>
