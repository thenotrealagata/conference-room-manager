
<x-app-layout>
    <x-primary-button>
        <a href="{{ route('workers.create') }}">Új dolgozó hozzáadása</a>
    </x-primary-button>
    <table class="table-auto">
        <tr>
            <th>Név</th>
            <th>Telefonszám</th>
            <th>Pozíció</th>
            <th>Szerkesztés</th>
            <th>Törlés</th>
            <th>Belépések</th>
        </tr>
        @foreach ($workers as $worker)
        <tr>
            <td>{{ $worker->name }}</td>
            <td>{{ $worker->phone_number }}</td>
            <td>{{ $worker->position->name }}</td>
            <td><x-primary-button>
                <a href="{{ route('workers.edit', ['worker' => $worker->id]) }}">Szerkesztés</a>
                </x-primary-button></td>
            <td>
                <form method="post" action="{{ route('workers.destroy', ['worker' => $worker->id]) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('delete')
                    <x-primary-button>Törlés</x-primary-button>
                </form>
            </td>
            <td><x-primary-button>
                <a href="{{ route('workers.entries', ['worker' => $worker->id]) }}">Belépések</a>
            </x-primary-button></td>
        </tr>
        @endforeach
    </table>
</x-app-layout>
