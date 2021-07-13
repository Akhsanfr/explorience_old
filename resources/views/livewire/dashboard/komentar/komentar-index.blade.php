<div>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Isi Komentar</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($komentars as $komentar)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="{{ route('show-artikel', ['slug' => $komentar->artikel->slug]) }}">{{$komentar->komen}}</a></td>
                    <td>
                        <a
                            class="btn btn-outline-{{ $komentar->is_active ? 'success' : 'danger' }}"
                            data-bs-toggle="modal" data-bs-target="#edit"
                            class="btn btn-danger"
                            wire:click="getKomentar({{ $komentar->id }})">
                            {{ $komentar->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Belum ada komentar</td>
                </tr>
            @endforelse
        </tbody>
      </table>
            {{-- Modal ubah --}}
        <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">Ubah Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Ubah status menjadi <b>{{ $komentar_is_active ? 'Tidak Aktif' : "Aktif" }}</b>?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form wire:submit.prevent="updateStatus">
                            <button type="submit"  data-bs-dismiss="modal" class="btn btn-primary">Ubah Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
