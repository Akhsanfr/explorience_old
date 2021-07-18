<div>
    @can('writer-only')
    <div class="row">
        <a href="{{ route('artikels.create') }}" class="btn btn-primary">Tulis artikel</a>
    </div>
    @endcan
    <table class="table table-hover">
        <thead>
          <tr >
            <th scope="col">#</th>
            <th scope="col">Kategori</th>
            <th scope="col">Judul</th>
            <th scope="col">Penulis</th>
            <th scope="col">Penyunting</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($artikels as $artikel)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$artikel->kategori->nama}}</td>
                    <td>
                        @if ($artikel->supervisor_id)
                            <a href="{{ route('show-artikel',['slug'=> $artikel->slug]) }}">{{$artikel->judul}}</a>
                            @else
                            {{$artikel->judul}}
                        @endif
                    </td>
                    <td>{{ $artikel->writer->nama}}</td>
                    <td>{!! $artikel->supervisor->nama ?? '<span class="text-danger">Belum ada penyunting</span>'!!}</td>
                    <td>{{ $artikel->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-info" href="{{ route('artikels.show', ['artikel'=> $artikel->id]) }}">Lihat</a>
                            @can('writer-only')
                            <a
                            data-bs-toggle="modal" data-bs-target="#delete"
                            class="btn btn-danger {{ $artikel->is_active ? 'disabled' : '' }}"
                            wire:click="getArtikel({{ $artikel->id }})">
                            Hapus
                        </a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan='7' class="text-center"> Tidak ada data artikel </td>
                <tr>
            @endforelse
        </tbody>
      </table>
    {{-- Modal delete --}}
    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Hapus Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hapus artikel berjudul <strong>{{ $artikel->judul ?? '' }}</strong>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form wire:submit.prevent="deleteArtikel">
                        <button type="submit"  data-bs-dismiss="modal" class="btn btn-danger">Hapus Artikel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
