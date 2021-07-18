<div>
    @if ($nilai == null)
        <h5>{{ $kuis->pertanyaan }}</h5>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jawaban" id="jawaban-a" wire:model="jawaban" value="a" wire:click="tambahJawaban">
            <label class="form-check-label" for="jawaban-a">
            {{ $kuis->a }}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jawaban" id="jawaban-b" wire:model="jawaban" value="b" wire:click="tambahJawaban">
            <label class="form-check-label" for="jawaban-b">
            {{ $kuis->b }}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jawaban" id="jawaban-c" wire:model="jawaban" value="c" wire:click="tambahJawaban">
            <label class="form-check-label" for="jawaban-c">
            {{ $kuis->c }}
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="jawaban" id="jawaban-d" wire:model="jawaban" value="d" wire:click="tambahJawaban">
            <label class="form-check-label" for="jawaban-d">
            {{ $kuis->d }}
            </label>
        </div>
        <div>
            @if($index_kuis != 0)
                <button class="btn btn-primary" wire:click="prevQuestion">Prev</button>
            @endif
            @if($index_kuis == ($jumlah_kuis - 1))
                <button class="btn btn-primary ms-3" wire:click="submit">Submit</button>
            @else
                <button class="btn btn-primary ms-3" wire:click="nextQuestion">Next</button>
            @endif
        </div>
    @else
        <div>
            Nilai kamu {{ $nilai }} / {{ $jumlah_kuis }}
        </div>
    @endif

</div>
