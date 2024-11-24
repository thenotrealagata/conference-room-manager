<x-app-layout>
    <h1 class="ps-3">{{ isset($position) ? $position->name : 'Új munkakör'}}</h1>
    <hr />
    <form method="POST" action="{{ isset($position) ? route('positions.update', ['position' => $position->id]) : route('positions.store') }}">
        @csrf
        @isset($position)
            @method('patch')
        @endisset
        <div class="row mb-3">
            <div class="col">
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    placeholder="Név"
                    name="name"
                    id="name"
                    value="{{ old('name', $position->name ?? '') }}"
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @empty($position)
            @endempty
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary">Mentés</button>
        </div>
    </form>
</x-app-layout>
