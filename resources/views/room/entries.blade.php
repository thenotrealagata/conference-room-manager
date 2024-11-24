<x-app-layout>
    <table>
        <tr>
            <th>Dátum</th>
            <th>Név</th>
            <th>Telefonszám</th>
            <th>Munkakör</th>
            <th>Sikeres</th>
        </tr>
        @foreach ($entries as $entry)
            <tr>
                <td>{{ $entry->created_at }}</td>
                <td>{{ $entry->user->name }}</td>
                <td>{{ $entry->user->phone_number }}</td>
                <td>{{ $entry->user->position->name }}</td>
                <td>{{ $entry->successful }}</td>
            </tr>
        @endforeach
    </table>
    {{ $entries->links() }}
</x-app-layout>
