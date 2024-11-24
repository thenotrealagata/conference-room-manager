<x-app-layout>
    <h1>{{ $position->name }}</h1>
    <table>
        <tr>
            <th>Név</th>
            <th>Telefonszám</th>
        </tr>
        @foreach ($position->users as $worker)
        <tr>
            <td>{{ $worker->name }}</td>
            <td>{{ $worker->phone_number }}</td>
        </tr>
        @endforeach
    </table>
</x-app-layout>
