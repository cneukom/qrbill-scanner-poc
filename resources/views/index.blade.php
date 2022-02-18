<x-root>
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-body">
                <h1 class="mb-4">Scan QR Bills in your browser</h1>
                <p class="lead fst-italic text-muted">
                    This page demonstrates that modern web browsers are capable of scanning QR bills without installing
                    dedicated software on your computer and/or mobile phone.
                </p>
                <div class="row">
                    <div class="col">
                        <p>In order to scan a QR bill, you have the following options:</p>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-webcam-tab" data-bs-toggle="pill" data-bs-target="#pills-webcam" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Webcam</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-smartphone-tab" data-bs-toggle="pill" data-bs-target="#pills-smartphone" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Smartphone</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-webcam" role="tabpanel" aria-labelledby="pills-webcam-tab">
                                Scanner canvas to be initialized
                            </div>
                            <div class="tab-pane fade" id="pills-smartphone" role="tabpanel" aria-labelledby="pills-smartphone-tab">
                                <div data-qr-link="{{ route('registerScanner', [$token]) }}">QR code to be initialized</div>
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div data-bill-display-poll="{{ route('listen') }}">
                        Placeholder: display bill information
                        </div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="post" class="mt-4">
                    @csrf
                    To deregister your smartphones, you can always <a href="javascript:" onclick="this.parentNode.submit()">start a new session</a>
                </form>
            </div>
        </div>
        <p class="mt-2 text-center">A Proof of Concept by <a href="https://cneukom.ch">Cédric Neukom</a></p>
    </div>
</x-root>
