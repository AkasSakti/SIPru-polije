@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Peminjaman Ruangan') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ruangan.storePinjam', $ruangan->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_ruang" class="form-label">Kode Ruang</label>
                            <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" value="{{ $ruangan->kode_ruang }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_ruang" class="form-label">Nama Ruang</label>
                            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" value="{{ $ruangan->nama_ruang }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="start_pinjam" class="form-label">Start Pinjam</label>
                            <input type="datetime-local" class="form-control" id="start_pinjam" name="start_pinjam" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_pinjam" class="form-label">End Pinjam</label>
                            <input type="datetime-local" class="form-control" id="end_pinjam" name="end_pinjam" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
