<x-app-layout>
    <form method="POST" enctype="multipart/form-data" action="{{route('rooms.attemptEntry')}}">
        @csrf
        <select name="room" id="room">
            @foreach ($rooms as $room)
                <option value="{{$room->id}}">{{$room->name}}</option>
            @endforeach
        </select>
        <br>
        <select name="worker" id="worker">
            @foreach ($workers as $worker)
                <option value="{{$worker->id}}">{{$worker->name}}</option>
            @endforeach
        </select>
        <div class="row">
            <button type="submit" class="btn btn-primary">Szimuláció</button>
        </div>
    </form>
</x-app-layout>
