<x-root title="Handheld Scanner">
    <p>Your device id is {{ $device->id }}</p>
    <div data-remote-display-url="{{ route('scans') }}"></div>
</x-root>
