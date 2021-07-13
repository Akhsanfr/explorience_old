@extends('layouts.dashboard')
@section('content')
<div>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    @if ($type == 'create')
        <form method="POST" action="{{ route('artikels.store') }}" enctype="multipart/form-data">
    @else
        <form method="POST" action="{{ route('artikels.update', ['artikel'=> $artikel]) }}" enctype="multipart/form-data">
        @method("PATCH")
    @endif
        @csrf
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') ?? $artikel->judul ?? '' }}">
            @error('judul')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" value="{{ old('gambar') ?? $artikel->gambar ?? '' }}">
                  @error('kategori_id')
                      <div class="invalid-feedback">
                          {{$message}}
                      </div>
                  @enderror
            </div>
            <div class="col">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select id="kategori_id" class="form-select  @error('kategori_id') is-invalid @enderror"" aria-label="Default select example" name="kategori_id">\
                    <option> Pilih kategori</option>
                    @forelse ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            @if($kategori->id == (old('kategori') ?? $artikel->kategori_id ?? '' ))
                                selected
                            @endif
                        >{{ $kategori->nama }}</option>
                    @empty
                        <option disabled> Tidak ada kategori yang tersedia</option>
                    @endforelse
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-3" wire:ignore>
          <label for="konten" class="form-label">Isi</label>
          <textarea  type="text" class="form-control" id="editor" name="konten" rows="10"> {{ old('konten') ?? $artikel->konten ?? '' }} </textarea>
        </div>
        @if ($type = 'create')
            <button type="submit" class="btn btn-primary">Submit</button>
        @else
            <button type="submit" class="btn btn-primary">Update</button>
        @endif
      </form>
      <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
</div>

@endsection
