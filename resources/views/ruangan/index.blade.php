@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Kelola Ruangan</h1>

    <!-- Form Tambah Ruangan -->
    <form action="{{ route('ruangan.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-2">
                <input type="text" name="kode_ruang" class="form-control" placeholder="Kode Ruang" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="nama_ruang" class="form-control" placeholder="Nama Ruang" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="kapasitas" class="form-control" placeholder="Kapasitas" required 
                       inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success">Tambah Ruangan</button>
            </div>
        </div>
    </form>

    <!-- Tabel Daftar Ruangan -->
    <table class="table">
        <thead>
            <tr>
                <th>Kode Ruang</th>
                <th>Nama Ruang</th>
                <th>Kapasitas</th>
                <th>Status Peminjaman</th>
                @if(Auth::user()->keterangan == 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($ruangan as $r)
                <tr>
                    <td>{{ $r->kode_ruang }}</td>
                    <td>{{ $r->nama_ruang }}</td>
                    <td>{{ $r->kapasitas }}</td>
                    <td>
                        @if($r->verifikasi)
                            Dipesan dari {{ $r->start_pinjam }} hingga {{ $r->end_pinjam }}
                        @else
                            Tersedia
                        @endif
                    </td>
                    @if(Auth::user()->keterangan == 'admin')
                        <td>
                            <!-- Button Edit -->
                            <a href="{{ route('ruangan.edit', $r->id) }}" class="btn btn-warning">Edit</a>

                            <!-- Button Hapus dengan Konfirmasi -->
                            <form action="{{ route('ruangan.destroy', $r->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                    Hapus
                                </button>
                            </form>

                            <!-- Button Verifikasi -->
                            @if(!$r->verifikasi)
                                <form action="{{ route('ruangan.verify', $r->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                                </form>
                            @endif
                        </td>
                    @elseif(Auth::user()->keterangan == 'mahasiswa' && !$r->verifikasi)
                        <td>
                            <a href="{{ route('ruangan.book', $r->id) }}" class="btn btn-info">Pesan</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
