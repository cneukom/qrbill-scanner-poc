<x-root title="Handheld Scanner">
    <p>Your device id is {{ $device->id }}</p>
    <div data-preview>
        <select class="form-select"></select>
        <video class="mt-3"></video>
    </div>
    <div data-remote-display-url="{{ route('scans') }}"></div>
</x-root>
