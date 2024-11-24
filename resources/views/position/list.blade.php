<x-app-layout>
    @if (Auth::user()->admin)
    <x-primary-button>
        <a href="{{ route('positions.create') }}">Új pozíció hozzáadása</a>
    </x-primary-button>
    @endif
    <table class="table-auto">
        <tr>
            <th>Név</th>
            <th>Dolgozók száma</th>
            <th>Jogosultságok</th>
            <th>Dolgozók</th>
            @if (Auth::user()->admin)
                <th>Szerkesztés</th>
                <th>Törlés</th>
                <th>Belépések</th>
            @endif
        </tr>
        @foreach ($positions as $position)
        <tr>
            <td>{{$position->name}}</td>
            <td>{{$position->users()->count()}}</td>
            <td>
                @foreach ($position->rooms as $room)
                    <p>{{$room->name}}</p>
                @endforeach
            </td>
            <td>
                <a href="{{ route('positions.workers', ['position' => $position->id]) }}">Dolgozók</a>
            </td>
            @if (Auth::user()->admin)
                <td>
                    <a href="{{ route('positions.edit', ['position' => $position->id]) }}">Szerkesztés</a>
                </td>
                <td>
                    <form method="post" action="{{ route('positions.destroy', ['position' => $position->id]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('delete')
                        <button>Törlés</button>
                    </form>
                </td>
                <td>
                    <a>Belépések</a>
                </td>
            @endif
        </tr>
        @endforeach
    </table>
</x-app-layout>
