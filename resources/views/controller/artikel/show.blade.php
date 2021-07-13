@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row">
        @can('writer-only')
            <a href="{{ route('artikels.edit', ['artikel'=> $artikel]) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('supervisor-only')
            <a href="{{ route('artikel-ubah-status', ['artikel'=> $artikel]) }}" class="btn btn-primary">Ubah Status</a>
        @endcan
    </div>
    {{-- Card Section --}}
    <div class="row mt-3">
        <div class="col-6">
            <div class="card shadow px-0 border-0 ms-0">
                Jumlah View
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow px-0 border-0">
                Jumlah ...
            </div>
        </div>
    </div>
    {{-- List Artikel's Property --}}
    <div class="row mt-3">
        <div class="card shadow px-0 border-0">
            <div class="card-header p-3">
                <h3>Atribut Artikel</h3>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-6"><img width="300px" src="{{ asset('storage/'.$artikel->gambar) }}" alt="Gambar"></div>
                    <div class="col-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action"><strong>Judul</strong> : {{ $artikel->judul }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Kategori</strong> : {{ $artikel->kategori->nama }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Status</strong> : {{ $artikel->is_active ? 'Aktif' : 'Tidak Aktif' }}</li>
                            <li class="list-group-item list-group-item-action"><strong>Supervisor</strong> : {{ $artikel->superviser_id ? '' : 'Belum disetujui' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Content --}}
    <div class="row mt-3">
        <div class="card shadow px-0 border-0">
            <div class="card-header"><h3>Isi Artikel</h3></div>
            <div class="card-body p-3">
                {!! $artikel->konten !!}
            </div>
        </div>
    </div>
</div>
@endsection
