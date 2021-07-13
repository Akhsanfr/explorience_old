<div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Roles</th>
            <th scope="col">Status</th>
            @can('update', App\Models\User::class)
                <th scope="col">Aksi</th>
            @endcan
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div
                        @can('update',App\Models\User::class)
                            data-bs-toggle="modal" data-bs-target="#role"
                            wire:click="getUserRole({{ $user->id}},{{$user->roles}})"
                        @endcan
                        class="btn-group" role="group" aria-label="Basic outlined example">
                            @forelse ($user->roles as $role)
                                <button type="button" class="btn btn-outline-primary">{{ $role->nama }}</button>
                            @empty
                                <button type="button" class="btn btn-outline-primary">Tidak memili role</button>
                            @endforelse
                        </div>
                    </td>
                    <td>
                        <a
                            class="btn btn-{{ $user->is_active ? 'success' : 'secondary' }}"
                            @can('update', App\Models\User::class)
                            data-bs-toggle="modal" data-bs-target="#activate"
                            wire:click="getUser({{ $user->id }})"
                            @endcan
                            >
                            {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </a>
                    </td>
                    @can('delete', App\Models\User::class)
                        <td>
                            <a
                                data-bs-toggle="modal" data-bs-target="#delete"
                                class="btn btn-danger"
                                wire:click="getUser({{ $user->id }})">
                                Hapus
                            </a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
      </table>
      {{-- Modal delete --}}
    <div wire:ignore.self class="modal fade" id="activate" tabindex="-1" aria-labelledby="activateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="activateLabel">Hapus User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Ubah status <span class="text-uppercase">{{ $user->nama }}</span> menjadi <b>{{ $user->is_active ? 'Tidak Aktif' : "Aktif" }}</b>?
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
    <div wire:ignore.self class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Ubah Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hapus data <span class="text-uppercase">{{ $user->nama }}</span>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form wire:submit.prevent="deleteUser">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Ubah Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="role" tabindex="-1" aria-labelledby="roleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleLabel">Role User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="role">
                    <div class="modal-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="administrator" wire:model="admin">
                            <label class="form-check-label" for="administrator">Administrator</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="supervisor" wire:model="supervisor">
                            <label class="form-check-label" for="supervisor">Supervisor</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="writer" wire:model="writer">
                            <label class="form-check-label" for="writer">Writer</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="podcaster" wire:model="podcaster">
                            <label class="form-check-label" for="podcaster">Podcaster</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  data-bs-dismiss="modal" class="btn btn-primary">Ubah Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


