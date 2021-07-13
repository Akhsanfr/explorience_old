<div>
    <img src="{{asset('img/logo.png')}}" alt="Logo Explorience" width="20px" class="shadow">
    <span class="text-uppercase fw-bold">explorience</span>
    <hr>
    <x-sidebar.kategori>Users</x-sidebar-kategori>
        <x-sidebar.judul icon="bi-person-fill" link="user-index">Daftar Team</x-sidebar>
        @can('admin-only')
            <x-sidebar.judul icon="bi-person-fill" link="user-writer">Daftar Writer</x-sidebar>
            <x-sidebar.judul icon="bi-person-fill" link="user-podcaster">Daftar Podcaster</x-sidebar>
        @endcan
    <hr>
    <x-sidebar.kategori>Artikel</x-sidebar-kategori>
        @can('admin-only')
            <x-sidebar.judul icon="bi-person-fill" link="kategori-index">Daftar Kategori</x-sidebar>
        @endcan
            <x-sidebar.judul icon="bi-person-fill" link="artikel-index">Daftar Artikel</x-sidebar>
        @can('supervisor-only')
            <x-sidebar.judul icon="bi-person-fill" link="komentar-index">Daftar Komentar</x-sidebar>
        @endcan


    <hr>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-warning" type="submit">Keluar</button>
    </form>

</div>
