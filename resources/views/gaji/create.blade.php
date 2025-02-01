@extends('layouts.app')

@section('title', 'Tambah Gaji')

@section('content')
    <div class="container">
        <h2 class="mb-4">Tambah Gaji Karyawan</h2>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Form untuk menambah data gaji -->
        <form action="{{ route('gaji.store') }}" method="POST">
            @csrf
            <!-- Departemen Dropdown -->
            <div class="mb-3">
                <label for="ID_Departemen" class="form-label">Departemen</label>
                <select class="form-control" id="ID_Departemen" name="ID_Departemen" required>
                    <option value="">-- Pilih Departemen --</option>
                    @foreach ($departemens as $departemen)
                        <option value="{{ $departemen->ID_Departemen }}">{{ $departemen->Nama_Departemen }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jabatan Dropdown (Akan diisi secara dinamis) -->
            <div class="mb-3">
                <label for="ID_Jabatan" class="form-label">Jabatan</label>
                <select class="form-control" id="ID_Jabatan" name="ID_Jabatan" required>
                    <option value="">-- Pilih Jabatan --</option>
                </select>
            </div>

            <!-- Karyawan Dropdown (Akan diisi secara dinamis) -->
            <div class="mb-3">
                <label for="ID_Karyawan" class="form-label">Karyawan</label>
                <select class="form-control" id="ID_Karyawan" name="ID_Karyawan" required>
                    <option value="">-- Pilih Karyawan --</option>
                </select>
            </div>

            <!-- Menampilkan Min/Max Gaji -->
            <div class="mb-3">
                <label for="Min_Max_Gaji" class="form-label">Min / Max Gaji</label>
                <input type="text" class="form-control" id="Min_Max_Gaji" readonly>
            </div>

            <!-- Gaji Pokok -->
            <div class="mb-3">
                <label for="Gaji_Pokok" class="form-label">Gaji Pokok</label>
                <input type="number" class="form-control" id="Gaji_Pokok" name="Gaji_Pokok" required>
            </div>

            <!-- Tunjangan -->
            <div class="mb-3">
                <label for="Tunjangan" class="form-label">Tunjangan</label>
                <input type="number" class="form-control" id="Tunjangan" name="Tunjangan" required>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Gaji</button>
        </form>
    </div>

    <!-- JavaScript untuk menangani pemilihan jabatan dan karyawan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika dropdown Departemen diubah
            $('#ID_Departemen').change(function() {
                var departemenId = $(this).val();
                var jabatanDropdown = $('#ID_Jabatan');
                var karyawanDropdown = $('#ID_Karyawan');
                var minMaxGaji = $('#Min_Max_Gaji');

                // Mengosongkan dropdown Jabatan dan Karyawan sebelumnya
                jabatanDropdown.empty().append('<option value="">-- Pilih Jabatan --</option>');
                karyawanDropdown.empty().append('<option value="">-- Pilih Karyawan --</option>');
                minMaxGaji.val(''); // Reset Min/Max Gaji

                if (departemenId) {
                    // Ambil data Jabatan berdasarkan Departemen yang dipilih
                    $.ajax({
                        url: '/get-jabatan/' + departemenId,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                // Menambahkan pilihan jabatan pada dropdown
                                $.each(data, function(index, jabatan) {
                                    jabatanDropdown.append('<option value="' + jabatan
                                        .ID_Jabatan + '" data-min-gaji="' + jabatan
                                        .Min_Gaji + '" data-max-gaji="' + jabatan
                                        .Max_Gaji + '">' + jabatan.Nama_Jabatan +
                                        '</option>');
                                });
                            }
                        },
                        error: function() {
                            alert('Gagal mendapatkan data jabatan');
                        }
                    });
                }
            });

            // Ketika dropdown Jabatan diubah
            $('#ID_Jabatan').change(function() {
                var jabatanId = $(this).val();
                var karyawanDropdown = $('#ID_Karyawan');
                var selectedOption = $(this).find('option:selected');
                var minGaji = selectedOption.data('min-gaji');
                var maxGaji = selectedOption.data('max-gaji');

                // Menampilkan Min/Max Gaji pada field Min_Max_Gaji
                $('#Min_Max_Gaji').val('Min Gaji: Rp ' + new Intl.NumberFormat().format(minGaji) +
                    ' | Max Gaji: Rp ' + new Intl.NumberFormat().format(maxGaji));

                // Mengosongkan dropdown Karyawan sebelumnya
                karyawanDropdown.empty().append('<option value="">-- Pilih Karyawan --</option>');

                if (jabatanId) {
                    // Ambil data Karyawan berdasarkan Jabatan yang dipilih
                    $.ajax({
                        url: '/get-karyawan/' + jabatanId,
                        type: 'GET',
                        success: function(data) {
                            if (data.length > 0) {
                                // Menambahkan pilihan karyawan pada dropdown
                                $.each(data, function(index, karyawan) {
                                    karyawanDropdown.append('<option value="' + karyawan
                                        .ID_Karyawan + '">' + karyawan
                                        .Nama_Karyawan + '</option>');
                                });
                            }
                        },
                        error: function() {
                            alert('Gagal mendapatkan data karyawan');
                        }
                    });
                }
            });
        });
    </script>
@endsection
