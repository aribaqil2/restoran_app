@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Form Tambah QR Code Meja -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Buat QR Code Meja</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.tables.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nomor / Nama Meja</label>
                            <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Contoh: 01, 02, atau VIP-1" value="{{ old('number') }}" required>
                            @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Generate & Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar QR Code Tersimpan -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar QR Code Meja</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nomor Meja</th>
                                    <th>Preview QR</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tables as $index => $table)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="fw-bold text-center">Meja {{ $table->number }}</td>
                                        <td class="text-center">
                                            @if($table->qr_code_path)
                                                <img src="{{ asset('storage/' . $table->qr_code_path) }}" alt="QR Meja {{ $table->number }}" width="80">
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.tables.print', $table->id) }}" target="_blank" class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-printer"></i> Cetak / Print
                                            </a>
                                            <a href="{{ asset('storage/' . $table->qr_code_path) }}" download="QR-Meja-{{ $table->number }}.svg" class="btn btn-sm btn-info me-1">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                            <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus QR Code Meja ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada QR Code meja yang dibuat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection