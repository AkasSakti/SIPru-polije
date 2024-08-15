@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if(auth()->user()->keterangan === 'admin')
                        <div class="alert alert-info mt-3">
                            <strong>Info:</strong> Selamat datang Admin. Anda dapat mengelola data ruangan.
                            <br><br>
                            <a href="{{ route('ruangan.index') }}" class="btn btn-primary">Kelola Ruangan</a> <!-- Link untuk kelola ruangan -->
                        </div>
                    @endif

                    <div class="container mt-4">
                        <h1>Daftar Ruangan</h1>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Ruang</th>
                                    <th>Nama Ruang</th>
                                    <th>Kapasitas</th>
                                    <th>Start Pinjam</th>
                                    <th>End Pinjam</th>
                                    <th>Verifikasi</th>
                                    <th>Aksi</th> <!-- Tambahkan kolom Aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ruangan as $r)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $r->kode_ruang }}</td>
                                        <td>{{ $r->nama_ruang }}</td>
                                        <td>{{ $r->kapasitas }}</td>
                                        <td>{{ $r->start_pinjam }}</td>
                                        <td>{{ $r->end_pinjam }}</td>
                                        <td>{{ $r->verifikasi ? 'Terverifikasi' : 'Belum Diverifikasi' }}</td>
                                        <td>
                                            @if(!$r->verifikasi) <!-- Jika belum diverifikasi, tampilkan tombol -->
                                                <a href="{{ route('ruangan.pinjam', $r->id) }}" class="btn btn-primary">Pinjam Ruangan</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
