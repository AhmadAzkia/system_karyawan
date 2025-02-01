@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Absen</h2>

        <form action="{{ route('absen.update', $absen->id_absensi) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ID Absen (tidak bisa diubah) -->
            <div class="mb-3">
                <label for="id_absensi" class="form-label">ID Absen</label>
                <input type="text" class="form-control" id="id_absensi" name="id_absensi" value="{{ $absen->id_absensi }}"
                    readonly>
            </div>

            <!-- Dropdown untuk Nama Karyawan -->
            <div class="mb-3">
                <label for="id_karyawan" class="form-label">Nama Karyawan</label>
                <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawan as $karyawan_item)
                        <option value="{{ $karyawan_item->ID_Karyawan }}"
                            {{ $absen->id_karyawan == $karyawan_item->ID_Karyawan ? 'selected' : '' }}>
                            {{ $karyawan_item->Nama_Karyawan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Absen -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $absen->tanggal }}" required>
            </div>

            <!-- Jam Masuk -->
            <div class="mb-3">
                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ $absen->jam_masuk }}" required>
            </div>

            <!-- Jam Keluar -->
            <div class="mb-3">
                <label for="jam_keluar" class="form-label">Jam Keluar</label>
                <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="{{ $absen->jam_keluar }}">
            </div>

            <!-- Status Kehadiran -->
            <div class="mb-3">
                <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                <select class="form-control" id="status_kehadiran" name="status_kehadiran" required>
                    <option value="Hadir" {{ $absen->status_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Izin" {{ $absen->status_kehadiran == 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Alpa" {{ $absen->status_kehadiran == 'Alpa' ? 'selected' : '' }}>Alpa</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
