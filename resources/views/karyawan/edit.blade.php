v@extends('layouts.app')

@section('title', 'Edit Gaji')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Gaji Karyawan</h2>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form untuk mengedit data gaji -->
        <form action="{{ route('gaji.update', $gaji->ID_Gaji) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Karyawan Dropdown (Read-Only) -->
            <div class="mb-3">
                <label for="ID_Karyawan" class="form-label">Karyawan</label>
                <select class="form-control" id="ID_Karyawan" name="ID_Karyawan" disabled>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->ID_Karyawan }}"
                            {{ $gaji->ID_Karyawan == $karyawan->ID_Karyawan ? 'selected' : '' }}>
                            {{ $karyawan->Nama_Karyawan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jabatan Dropdown (Read-Only, Selected Based on Karyawan) -->
            <div class="mb-3">
                <label for="ID_Jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="ID_Jabatan" name="ID_Jabatan"
                    value="{{ $jabatan->Nama_Jabatan }}" disabled>
            </div>

            <!-- Tampilkan Min dan Max Gaji -->
            <div class="mb-3">
                <label for="Min_Gaji" class="form-label">Gaji Min</label>
                <input type="text" class="form-control" id="Min_Gaji" name="Min_Gaji"
                    value="Rp {{ number_format($jabatan->Min_Gaji, 0, ',', '.') }}" disabled>
            </div>

            <div class="mb-3">
                <label for="Max_Gaji" class="form-label">Gaji Max</label>
                <input type="text" class="form-control" id="Max_Gaji" name="Max_Gaji"
                    value="Rp {{ number_format($jabatan->Max_Gaji, 0, ',', '.') }}" disabled>
            </div>

            <!-- Gaji Pokok (Editable) -->
            <div class="mb-3">
                <label for="Gaji_Pokok" class="form-label">Gaji Pokok</label>
                <input type="number" class="form-control" id="Gaji_Pokok" name="Gaji_Pokok" value="{{ $gaji->Gaji_Pokok }}"
                    required>
            </div>

            <!-- Tunjangan (Editable) -->
            <div class="mb-3">
                <label for="Tunjangan" class="form-label">Tunjangan</label>
                <input type="number" class="form-control" id="Tunjangan" name="Tunjangan" value="{{ $gaji->Tunjangan }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Gaji</button>
        </form>

    </div>
@endsection
