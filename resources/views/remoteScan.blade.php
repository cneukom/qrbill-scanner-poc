<x-root title="Handheld Scanner">
    <p>Your device id is {{ $device->id }}</p>
    <form action="{{ route('scans') }}" method="post">
        @csrf
        <textarea name="content">Your data</textarea>
        <input type="submit" value="Post scan"/>
    </form>
</x-root>
