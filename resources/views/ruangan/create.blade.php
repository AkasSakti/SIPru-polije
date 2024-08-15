@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Ruangan</h1>

    <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_ruang" class="form-label">Kode Ruang</label>
            <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" required>
        </div>
        <div class="mb-3">
            <label for="nama_ruang" class="form-label">Nama Ruang</label>
            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
