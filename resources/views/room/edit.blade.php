<x-app-layout>
    <h1 class="ps-3">{{ isset($room) ? $room->name : 'Új szoba'}}</h1>
    <hr />
    <form method="POST" enctype="multipart/form-data" action="{{ isset($room) ? route('rooms.update', ['room' => $room->id]) : route('rooms.store') }}">
        @csrf
        @isset($room)
            @method('patch')
        @endisset
        <div class="row mb-3">
            <div class="mb-3">
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Név"
                    name="name"
                    id="name"
                    value="{{ old('name', $room->name ?? '') }}"
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <textarea
                    type="text"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Leírás"
                    name="description"
                    id="description"
                >{{ old('description', $room->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class='mb-3'>
                @foreach ($positions as $position)
                    <input {{ $room->positions->find($position->id) !== null ? 'checked' : '' }}  type="checkbox" name="position_id[]" value="{{ $position->id }}" />
                    <label for="{{ $position->id }}">{{ $position->name }}</label>
                @endforeach
            </div>
            <div class="mb-3">
                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file">
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @empty($room)
            @endempty
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary">Mentés</button>
        </div>
    </form>
</x-app-layout>
