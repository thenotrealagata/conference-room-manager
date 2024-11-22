<x-app-layout>
    <h1 class="ps-3">{{ isset($worker) ? $worker->name : 'Új dolgozó'}}</h1>
    <hr />
    <form method="POST" action="{{ isset($worker) ? route('workers.update', ['worker' => $worker->id]) : route('workers.store') }}">
        @csrf
        @isset($worker)
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
                    value="{{ old('name', $worker->name ?? '') }}"
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <input
                    type="text"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="E-mail"
                    name="email"
                    id="email"
                    value="{{ old('email', $worker->email ?? '') }}"
                />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <input
                    type="text"
                    class="form-control @error('phone_number') is-invalid @enderror"
                    placeholder="Telefonszám"
                    name="phone_number"
                    id="phone_number"
                    value="{{ old('phone_number', $worker->phone_number ?? '') }}"
                />
                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <input
                    type="text"
                    class="form-control @error('card_number') is-invalid @enderror"
                    placeholder="Kártyaszám"
                    name="card_number"
                    id="card_number"
                    value="{{ old('card_number', $worker->card_number ?? '') }}"
                />
                @error('card_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @empty($worker)
            <!--<div class="mb-3">
                <textarea class="form-control @error('name') is-invalid @enderror" name="text" id="text" cols="30" rows="10" placeholder="Hiba leírása...">{{ old('text') }}</textarea>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="file" class="form-control @error('file') is-invalid @enderror" name="file" id="file">
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>-->
            Még nincs dolgozó ezen az id-n!
        @endempty
        <div class="row">
            <button type="submit" class="btn btn-primary">Mentés</button>
        </div>
    </form>
</x-app-layout>
