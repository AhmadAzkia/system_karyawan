@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')
    <h1>Edit Karyawan</h1>
    <form action="{{ route('karyawan.update', $karyawan->ID_Karyawan) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Input untuk Nama Karyawan -->
        <div class="mb-3">
            <label for="Nama_Karyawan" class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" id="Nama_Karyawan" name="Nama_Karyawan"
                value="{{ $karyawan->Nama_Karyawan }}" required>
        </div>

        <!-- Dropdown untuk Departemen -->
        <div class="mb-3">
            <label for="ID_Departemen" class="form-label">Departemen</label>
            <select class="form-control" id="ID_Departemen" name="ID_Departemen" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach ($departemens as $departemen)
                    <option value="{{ $departemen->ID_Departemen }}"
                        {{ $departemen->ID_Departemen == $karyawan->ID_Departemen ? 'selected' : '' }}>
                        {{ $departemen->Nama_Departemen }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown untuk Jabatan -->
        <div class="mb-3">
            <label for="ID_Jabatan" class="form-label">Jabatan</label>
            <select class="form-control" id="ID_Jabatan" name="ID_Jabatan" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach ($jabatans as $jabatan)
                    <option value="{{ $jabatan->ID_Jabatan }}"
                        {{ $jabatan->ID_Jabatan == $karyawan->ID_Jabatan ? 'selected' : '' }}>
                        {{ $jabatan->Nama_Jabatan }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Dropdown untuk Status Karyawan -->
        <div class="mb-3">
            <label for="Status_Karyawan" class="form-label">Status Karyawan</label>
            <select class="form-control" id="Status_Karyawan" name="Status_Karyawan">
                <option value="aktif" {{ $karyawan->Status_Karyawan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="non-aktif" {{ $karyawan->Status_Karyawan == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
            </select>
        </div>

        <!-- Dropdown untuk Jenis Kelamin -->
        <div class="mb-3">
            <label for="Jenis_Kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="Jenis_Kelamin" name="Jenis_Kelamin">
                <option value="L" {{ $karyawan->Jenis_Kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="P" {{ $karyawan->Jenis_Kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <!-- Input untuk Tempat dan Tanggal Lahir -->
        <div class="mb-3">
            <label for="Tempat_Tanggal_Lahir" class="form-label">Tempat dan Tanggal Lahir</label>
            <input type="text" class="form-control" id="Tempat_Tanggal_Lahir" name="Tempat_Tanggal_Lahir"
                value="{{ $karyawan->Tempat_Tanggal_Lahir }}">
        </div>

        <!-- Input untuk Nomor HP -->
        <div class="mb-3">
            <label for="Nomor_HP" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="Nomor_HP" name="Nomor_HP" value="{{ $karyawan->Nomor_HP }}">
        </div>

        <!-- Tombol Update -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Event listener ketika departemen berubah
            $('#ID_Departemen').change(function() {
                var departemenId = $(this).val();
                var jabatanDropdown = $('#ID_Jabatan');

                // Kosongkan dropdown jabatan
                jabatanDropdown.empty();
                jabatanDropdown.append('<option value="">-- Pilih Jabatan --</option>');

                // Jika departemen dipilih, lakukan AJAX untuk mendapatkan jabatan
                if (departemenId) {
                    $.ajax({
                        url: '/get-jabatan/' + departemenId,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(index, jabatan) {
                                    jabatanDropdown.append('<option value="' + jabatan.ID_Jabatan + '">' + jabatan.Nama_Jabatan + '</option>');
                                });
                            } else {
                                jabatanDropdown.append('<option value="">Tidak ada jabatan tersedia</option>');
                            }
                        },
                        error: function() {
                            alert('Gagal mendapatkan data jabatan');
                        }
                    });
                }
            });
        });
    </script>
@endsection
