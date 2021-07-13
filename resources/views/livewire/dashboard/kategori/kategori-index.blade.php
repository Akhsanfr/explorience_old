<div>
    <a
    data-bs-toggle="modal" data-bs-target="#tambah"
    class="btn btn-primary">
    Tambah Kategori
    </a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Nama (English)</th>
            <th scope="col">Jumlah artikel</th>
            <th scope="col">Jumlah artikel aktif</th>
            <th scope="col">Jumlah writer</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $kategori)
                <tr>
                    <th scope="row"> {{ $loop->iteration }} </th>
                    <td>{{$kategori->nama}}</td>
                    <td>{{$kategori->nama_en}}</td>
                    <td>{{$kategori->artikels->count()}}</td>
                    <td>{{$kategori->artikels->where('is_active', true)->count() }}</td>
                    <td>{{$kategori->users->count()}}</td>
                    @can('admin-only')
                        <td>
                            <div class="btn-group">
                                <a
                                    data-bs-toggle="modal" data-bs-target="#writer"
                                    class="btn btn-info"
                                    wire:click="getWriter({{ $kategori}})"
                                    >
                                    Ubah Writer
                                </a>
                                <a
                                    data-bs-toggle="modal" data-bs-target="#edit"
                                    class="btn btn-warning"
                                    wire:click="getKategori({{ $kategori->id }})"

                                    >
                                    Edit
                                </a>
                                <a
                                    data-bs-toggle="modal" data-bs-target="#delete"
                                    class="btn btn-danger {{ $kategori->artikels->count() ? 'disabled' : '' }}"
                                    wire:click="getKategori({{ $kategori->id }})">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    @endcan
                </tr>
              @endforeach
        </tbody>
      </table>
      <div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahLabel">Tambah Kategori</h5>
                    <button type="button"  wire:click.prevent="cancel()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="" wire:model="nama">
                            <label for="nama">Nama @error('nama') <span class="error">{{ $message }}</span> @enderror</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama_en') is-invalid @enderror" id="nama" placeholder="" wire:model="nama_en">
                            <label for="nama">Nama (English) @error('nama_en') <span class="error">{{ $message }}</span> @enderror</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary" data-bs-dismiss="modal">Tambah Kategori</button>
                </div>
            </div>
        </div>
    </div>
      <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Ubah Kategori</h5>
                    <button type="button"  wire:click.prevent="cancel()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="" wire:model="nama">
                            <label for="nama">Nama @error('nama') <span class="error">{{ $message }}</span> @enderror</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('nama_en') is-invalid @enderror" id="nama" placeholder="" wire:model="nama_en">
                            <label for="nama">Nama (English) @error('nama_en') <span class="error">{{ $message }}</span> @enderror</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-bs-dismiss="modal">edit Kategori</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Kategori</h5>
                    <button type="button"  wire:click.prevent="cancel()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menhapus kategori {{ $nama }} ini?
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger" data-bs-dismiss="modal">Hapus Kategori</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="writer" tabindex="-1" aria-labelledby="writerLabel" aria-hidden="true">
        <div class="modal-dialog" x-data="">

            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="writerLabel">Writer kategori {{ $kategori_nama }}</h5>
                    <button type="button"  wire:click.prevent="cancel()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @forelse ($writers as $writer)
                        <div class="form-check">
                            {{-- START INPUT --}}
                            <input class="form-check-input" type="checkbox" id="check-{{ $loop->iteration}}"
                            {{-- Cek apakah user memiliki kategori yang sama dengan kategori sekarang --}}
                            @foreach ($writer->kategoris->all() as $kategori_user)
                                {{($kategori_user->id == $kategori_id) ? 'checked' : ''}}
                            @endforeach
                            {{-- Jika input ditekan, toggle data kategori user --}}
                            @click="$wire.toggleWriter({{ $writer->id ?? '' }})" >
                            {{-- END INPUT --}}
                            <label class="form-check-label" for="check-{{ $loop->iteration}}">
                            {{ $writer->nama ?? ''}}
                            </label>
                        </div>
                    @empty
                        <div>Tidak ada Writer</div>
                    @endforelse
                    <input type="hidden" wire:modal='writer_id' value="" class="check-writer-target">
                </div>
                <div class="modal-footer" x-data="{ kata : [0,1] }">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</div>
