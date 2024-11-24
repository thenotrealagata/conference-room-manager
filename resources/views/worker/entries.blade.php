<x-app-layout>
    <h1>{{ $worker->name }}</h1>
    <table>
        <tr>
            <th>Dátum</th>
            <th>Szoba</th>
            <th>Sikeres</th>
        </tr>
        @foreach ($entries as $entry)
            <tr>
                <td>{{ $entry->created_at }}</td>
                <td>{{ $entry->room->name }}</td>
                <td>{{ $entry->successful ? 'Sikeres' : 'Sikertelen'  }}</td>
            </tr>
        @endforeach
    </table>
    {{ $entries->links() }}
</x-app-layout>
