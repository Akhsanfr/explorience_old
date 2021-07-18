<div>
    <a href="{{ route('welcome') }}">Back To Dashboard</a>
    <a href="{{ route('index-artikel') }}">Back To List Available article</a>
    <hr>
    <div class="container">
        <div class="row">
            <ul class="list-group">
                <li class="list-group-item"><h1>{{ $artikel->judul }}</h1></li>
                <li class="list-group-item">Ditulis oleh {{ $artikel->writer->nama }}</li>
                <li class="list-group-item">Telah disunting oleh {{ $artikel->supervisor->nama }}</li>
              </ul>
        </div>
        {{-- Kuis START --}}
        <div class="card shadow p-3 my-3" x-data="{ show : false }">
            <a class="btn btn-info" @click="show = !show">
                Show Kuis
            </a>
            <div x-show="show">
                <hr>
                @livewire('show.artikel.kuis-view', ['id' => $artikel->id])
            </div>
        </div>
        {{-- A --}}
        <hr>
        <div class="row">
            {!! $artikel->konten !!}
        </div>
        <hr>
        {{-- AREA KOMENTAR --}}
        {{-- Post a comment --}}
        <div class="row">
            @if(Auth::user())
                <div>
                    <div class="d-flex">
                        <input type="text"
                        class="form-control @error('first_komen') is-invalid @enderror"
                        wire:model="first_komen">
                        <button class="btn btn-primary px-5 ms-3" wire:click="saveFirstKomen">Post</button>
                    </div>
                    @error('first_komen')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @else
                <div><strong>Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu sebelum memberikan komentar</strong> </div>
            @endif
        </div>
        {{-- Get all komentar --}}
        <div class="row">
            @forelse ($artikel->komentars as $komentar)
                @if($komentar->id_parent == 0)
                    <div class="card mt-3">
                        <div class="card-body" x-data="{ reply : {{$reply}} }">
                            {{-- First Comment --}}
                            <div id="komen-{{ $komentar->id }}">
                                <p class="mb-1"><strong class="text-primary">{{$komentar->user->nama}}</strong> {{ $komentar->is_active ? $komentar->komen : 'Komentar ini melanggar peraturan'}}</p>
                                <span>{{ \Illuminate\Support\Carbon::parse($komentar->created_at)->diffForHumans(\Illuminate\Support\Carbon::now());}}</span>
                                @if(Auth::user())
                                &bull;
                                <a style="cursor: pointer" class="text-primary" wire:click="getParentId({{ $komentar->id }})">Reply</a>
                                @endif
                            </div>
                            {{-- Second Comment --}}
                            @foreach ($artikel->komentars as $komentar_second)
                                @if ($komentar_second->id_parent == $komentar->id)
                                    <div class="ms-3" id="komen-{{ $komentar_second->id }}">
                                        <p class="mb-1"><strong class="text-primary">{{$komentar_second->user->nama}}</strong>
                                            @if ($komentar_second->id_tag)
                                                <a href="#komen-{{ $komentar_second->id_tag }}">{{'@'.App\Models\Komentar::find($komentar_second->id_tag)->user->nama }}</a>
                                            @endif
                                            {{ $komentar_second->is_active ? $komentar_second->komen : 'Komentar ini melanggar peraturan'}}
                                        </p>
                                        <span>{{ \Illuminate\Support\Carbon::parse($komentar_second->created_at)->diffForHumans(\Illuminate\Support\Carbon::now());}}</span>
                                        @if(Auth::user())
                                            &bull;
                                            <a style="cursor: pointer" class="text-primary"
                                                wire:click="getParentId({{ $komentar->id }},{{$komentar_second->id }},'{{$komentar_second->user->nama }}')"
                                                >
                                                Reply
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                            {{-- Reply form --}}
                            <div x-show="reply == {{ $komentar->id }} ? true : false" x-transition>
                                <div class="d-flex">
                                    <input type="text"
                                    class="form-control @error('second_komen') is-invalid @enderror"
                                    placeholder="{{ $komentar_second_nama ?? '' }}"
                                    wire:model="second_komen">
                                    <button class="btn btn-primary px-5 ms-3" wire:click="saveSecondKomen">Post</button>
                                </div>
                                @error('second_komen')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            <div class="card mt-3">
                <div class="card-body">
                    Belum ada komentar
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

