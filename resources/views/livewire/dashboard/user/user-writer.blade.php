<div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Jumlah Artikel</th>
            <th scope="col">Jumlah Artikel Aktif</th>
            <th scope="col">Kategori Artikel</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($writers as $writer)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $writer->nama }}</td>
                    <td>{{ $writer->artikels_count }}</td>
                    <td>{{ $writer->artikels_active }}</td>
                    <td>
                        <div class="btn-group">
                            {{-- @dump($writer->kategoris) --}}
                            @forelse ($writer->kategoris as $kategori)
                                <a
                                data-bs-toggle="modal" data-bs-target="#kategori"
                                class="btn btn-outline-info"
                                wire:click="getWriter({{ $writer}})"
                                >
                                    {{$kategori->nama}}
                                </a>
                            @empty
                                <a
                                data-bs-toggle="modal" data-bs-target="#kategori"
                                class="btn btn-outline-warning"
                                wire:click="getWriter({{ $writer}})"
                                >
                                    Tidak memiliki kategori
                                </a>
                            @endforelse

                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data writer</td>
            </tr>
            @endforelse
        </tbody>
      </table>
      <div wire:ignore.self class="modal fade" id="kategori" tabindex="-1" aria-labelledby="kategoriLabel" aria-hidden="true">
        <div class="modal-dialog" x-data="">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="kategoriLabel">Kategori Writer <strong>{{ $writer_nama }}</strong></h5>
                    <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @forelse ($kategoris as $kategori)
                    {{-- @dump($kategori->users->all()) --}}
                        <div class="form-check">
                            {{-- START INPUT --}}
                            <input class="form-check-input" type="checkbox" id="check-{{ $loop->iteration}}"
                            {{-- Cek apakah user memiliki kategori yang sama dengan kategori sekarang --}}
                            @foreach ($kategori->users->all() as $writer_kategori )
                                    {{($writer_kategori->id == $writer_id) ? 'checked' : ''}}
                            @endforeach
                            {{-- Jika input ditekan, toggle data kategori user --}}
                            @click="$wire.toggleWriter({{ $kategori->id ?? '' }})" >
                            {{-- END INPUT --}}
                            <label class="form-check-label" for="check-{{ $loop->iteration}}">
                            {{ $kategori->nama ?? ''}}
                            </label>
                        </div>
                    @empty
                        <div>Tidak ada Writer</div>
                    @endforelse
                    {{-- <input type="hidden" wire:modal='writer_id' value="" class="check-writer-target"> --}}
                </div>
                <div class="modal-footer" x-data="{ kata : [0,1] }">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
