<div>
    @forelse ($kuises as $i)
        <div class="card shadow mt-3 p-3">
            @if ($edit != $i->id)
                <div class="d-flex">
                    <span><strong>{{ $loop->iteration }}.</strong> </span>
                    <span>{{ $i->pertanyaan }}</span>
                    <button class="btn btn-info ms-auto" wire:click="getKuis({{$i->id}})">
                        Edit
                    </button>
                </div>
                <hr>
                <p class="{{$i->jawaban == 'a' ? 'fw-bold' : ''}}">a. {{ $i->a }}</p>
                <p class="{{$i->jawaban == 'b' ? 'fw-bold' : ''}}">b. {{ $i->b }}</p>
                <p class="{{$i->jawaban == 'c' ? 'fw-bold' : ''}}">c. {{ $i->c }}</p>
                <p class="{{$i->jawaban == 'd' ? 'fw-bold' : ''}}">d. {{ $i->d }}</p>
            @else
                <div class="d-flex justify-content-end">
                    <span><strong>{{ $loop->iteration }}.</strong></span>
                    <textarea class="form-control" wire:model="pertanyaan">{{ $i->pertanyaan }} {{ $i->jawaban }}</textarea>
                    <button class="btn btn-warning ms-3" wire:click="simpan">
                        Simpan
                    </button>
                </div>
                <hr>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" wire:model="jawaban" name="jawaban" value="a" {{ ($i->jawaban == "a") ? 'checked' : '' }}>
                    </div>
                    <input type="text" class="form-control" wire:model="a">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" wire:model="jawaban" name="jawaban" value="b" {{ ($i->jawaban == "b") ? 'checked' : '' }}>
                    </div>
                    <input type="text" class="form-control" wire:model="b">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" wire:model="jawaban" name="jawaban" value="c" {{ ($i->jawaban == "c") ? 'checked' : '' }}>
                    </div>
                    <input type="text" class="form-control" wire:model="c">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="radio" wire:model="jawaban" name="jawaban" value="d" {{ ($i->jawaban == "d") ? 'checked' : '' }}>
                    </div>
                    <input type="text" class="form-control" wire:model="d">
                </div>
            @endif
        </div>
    @empty
    <div class="card shadow p-3">
        Belum ada kuis
    </div>
    @endforelse
    <div class="my-3">
        <a href="{{ route('artikels.show', ['artikel' => $id_artikel]) }}" class="btn btn-primary" wire:click="tambah">Kembali ke Artikel</a>
        <button class="btn btn-primary" wire:click="tambah">Tambah Pertanyaan</button>
    </div>
    @if ($tambah)
    <div class="mb-3 card shadow p-3">
        <div class="d-flex justify-content-end">
            <textarea class="form-control @error('pertanyaan') is-invalid @enderror" wire:model="pertanyaan" placeholder="Pertanyaan"></textarea>
            <button class="btn btn-warning ms-3" wire:click="simpan">
                Simpan
            </button>
        </div>
        <hr>
        <div class="input-group mb-3">
            <div class="input-group-text">
                <input class="form-check-input mt-0 @error('jawaban') is-invalid @enderror" type="radio" wire:model="jawaban" name="jawaban" value="a">
            </div>
            <input type="text" class="form-control @error('a') is-invalid @enderror" wire:model="a" placeholder="Jawaban a" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">
                <input class="form-check-input mt-0 @error('jawaban') is-invalid @enderror" type="radio" wire:model="jawaban" name="jawaban" value="b">
            </div>
            <input type="text" class="form-control @error('b') is-invalid @enderror" wire:model="b" placeholder="Jawaban b">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">
                <input class="form-check-input mt-0 @error('jawaban') is-invalid @enderror" type="radio" wire:model="jawaban" name="jawaban" value="c">
            </div>
            <input type="text" class="form-control @error('c') is-invalid @enderror" wire:model="c" placeholder="Jawaban c">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-text">
                <input class="form-check-input mt-0 @error('jawaban') is-invalid @enderror" type="radio" wire:model="jawaban" name="jawaban" value="d">
            </div>
            <input type="text" class="form-control @error('d') is-invalid @enderror" wire:model="d" placeholder="Jawaban d">
        </div>
        @error('jawaban')
            <div>
                <span class="text-danger"> Pilih jawaban yang benar terlebih dahulu!</span>
            </div>
        @enderror
    </div>
    @endif

</div>
