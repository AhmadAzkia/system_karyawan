@extends('layouts.app')

@section('title', 'Absensi Karyawan')

@section('content')
    <div class="container">
        <h2 class="mb-4">Absensi Karyawan</h2>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('absen.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_karyawan" class="form-label">Nama Karyawan</label>
                <select name="id_karyawan" class="form-control" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($karyawans as $karyawan)
                        <option value="{{ $karyawan->ID_Karyawan }}">{{ $karyawan->Nama_Karyawan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                <select name="status_kehadiran" class="form-control" required>
                    <option value="">-- Pilih Status Kehadiran --</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpa">Alpa</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Absen Masuk</button>
        </form>
    </div>
@endsection
