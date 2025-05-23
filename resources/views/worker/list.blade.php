
<x-app-layout>
    @if (Auth::user()->admin)
    <x-primary-button>
        <a href="{{ route('workers.create') }}">Új dolgozó hozzáadása</a>
    </x-primary-button>
    @endif
    <table class="table-auto">
        <tr>
            <th>Név</th>
            <th>Telefonszám</th>
            <th>Pozíció</th>
            @if (Auth::user()->admin)
            <th>Szerkesztés</th>
            <th>Törlés</th>
            <th>Belépések</th>
            @endif
        </tr>
        @foreach ($workers as $worker)
        <tr>
            <td>{{ $worker->name }}</td>
            <td>{{ $worker->phone_number }}</td>
            <td>{{ $worker->position->name }}</td>
            @if (Auth::user()->admin)
            <td><x-primary-button>
                <a href="{{ route('workers.edit', ['worker' => $worker->id]) }}">Szerkesztés</a>
                </x-primary-button></td>
            <td>
                <form method="post" action="{{ route('workers.destroy', ['worker' => $worker->id]) }}">
                    @csrf
                    @method('delete')
                    <x-primary-button>Törlés</x-primary-button>
                </form>
            </td>
            <td><x-primary-button>
                <a href="{{ route('workers.entries', ['worker' => $worker->id]) }}">Belépések</a>
            </x-primary-button></td>
            @endif
        </tr>
        @endforeach
    </table>
</x-app-layout>
