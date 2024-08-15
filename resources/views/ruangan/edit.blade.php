@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ruangan</h1>

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_ruang" class="form-label">Kode Ruang</label>
            <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" value="{{ $ruangan->kode_ruang }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_ruang" class="form-label">Nama Ruang</label>
            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" value="{{ $ruangan->nama_ruang }}" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="{{ $ruangan->kapasitas }}" required inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
