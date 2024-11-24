<x-app-layout>
    <h1>Szobák</h1>
    <table>
        <tr>
            <th>Név</th>
            <th>Jogosultságok</th>
            @if (Auth::user()->admin)
                <th>Szerkesztés</th>
                <th>Törlés</th>
                <th>Belépések</th>
            @endif
        </tr>
        @foreach ($rooms as $room)
            <tr>
                <td>{{ $room->name }}</td>
                <td>
                    @foreach ($room->positions as $position)
                        <p>{{ $position->name }}</p>
                    @endforeach
                </td>
                @if (Auth::user()->admin)
                    <td>
                        <a href="{{ route('rooms.edit', ['room' => $room->id]) }}">Szerkesztés</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('rooms.destroy', ['room' => $room->id]) }}">
                            @csrf
                            @method('delete')
                            <button>Törlés</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('rooms.entries', ['room' => $room->id]) }}">Belépések</a>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
</x-app-layout>
