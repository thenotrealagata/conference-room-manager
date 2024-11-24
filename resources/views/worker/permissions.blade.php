<x-app-layout>
    <h1>{{ $user->name }}</h1>
    <p>Pozíció: {{ $user->position->name }}</p>
    <table>
        <tr>
            <th>Szoba</th>
            <th>Kép</th>
            <th>Leírás</th>
        </tr>
        @foreach ($user->position->rooms as $room)
            <tr>
                <td>{{ $room->name }}</td>
                <td>
                    <div>
                        @if($room->filename)
                            <img src="{{ Storage::url($room->filename_hash) }}">
                        @endif
                    </div>
                </td>
                <td>{{ $room->description }}</td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
