<x-root title="Handheld Scanner">
    <div data-preview>
        <label for="camera-chooser" class="d-none">Choose camera</label>
        <select class="form-select" id="camera-chooser"></select>
        <video class="mt-3"></video>
    </div>
    <div data-remote-display-url="{{ route('scans') }}"></div>
</x-root>
