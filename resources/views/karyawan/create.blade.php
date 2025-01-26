@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
<h1>Tambah Karyawan</h1>
<form action="{{ route('karyawan.store') }}" method="POST">
    @csrf

    <!-- Nama Karyawan -->
    <div class="mb-3">
        <label for="Nama_Karyawan" class="form-label">Nama Karyawan</label>
        <input type="text" class="form-control" id="Nama_Karyawan" name="Nama_Karyawan" required>
    </div>

    <!-- Departemen -->
    <div class="mb-3">
        <label for="ID_Departemen" class="form-label">Departemen</label>
        <select class="form-control" id="ID_Departemen" name="ID_Departemen" required>
            <option value="">-- Pilih Departemen --</option>
            @foreach ($departemens as $departemen)
                <option value="{{ $departemen->ID_Departemen }}">{{ $departemen->Nama_Departemen }}</option>
            @endforeach
        </select>
    </div>

    <!-- Jabatan -->
    <div class="mb-3">
        <label for="ID_Jabatan" class="form-label">Jabatan</label>
        <select class="form-control" id="ID_Jabatan" name="ID_Jabatan" required>
            <option value="">-- Pilih Jabatan --</option>
        </select>
    </div>

    <!-- Tanggal Bergabung -->
    <div class="mb-3">
        <label for="Tanggal_Bergabung" class="form-label">Tanggal Bergabung</label>
        <input type="date" class="form-control" id="Tanggal_Bergabung" name="Tanggal_Bergabung" required>
    </div>

    <!-- Status Karyawan -->
    <div class="mb-3">
        <label for="Status_Karyawan" class="form-label">Status Karyawan</label>
        <select class="form-control" id="Status_Karyawan" name="Status_Karyawan" required>
            <option value="aktif">Aktif</option>
            <option value="non-aktif">Non-Aktif</option>
        </select>
    </div>

    <!-- Jenis Kelamin -->
    <div class="mb-3">
        <label for="Jenis_Kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-control" id="Jenis_Kelamin" name="Jenis_Kelamin" required>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <!-- Tempat dan Tanggal Lahir -->
    <div class="mb-3">
        <label for="Tempat_Tanggal_Lahir" class="form-label">Tempat dan Tanggal Lahir</label>
        <input type="text" class="form-control" id="Tempat_Tanggal_Lahir" name="Tempat_Tanggal_Lahir" required>
    </div>

    <!-- Nomor HP -->
    <div class="mb-3">
        <label for="Nomor_HP" class="form-label">Nomor HP</label>
        <input type="text" class="form-control" id="Nomor_HP" name="Nomor_HP" required>
    </div>

    <!-- Tombol Simpan -->
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<!-- Script untuk AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk ketika Departemen dipilih
        $('#ID_Departemen').change(function() {
            var departemenId = $(this).val();
            var jabatanDropdown = $('#ID_Jabatan');

            // Kosongkan dropdown jabatan
            jabatanDropdown.empty();
            jabatanDropdown.append('<option value="">-- Pilih Jabatan --</option>');

            // Jika departemen dipilih, lakukan AJAX untuk mengambil jabatan
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
