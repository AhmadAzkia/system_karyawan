@extends('layouts.app')

@section('title', 'Daftar Karyawan')

@section('content')

    <div class="container">
        <div class="header d-flex justify-content-between align-items-center mb-3">
            <h1 class=" w-100">Daftar Karyawan</h1>
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary w-25">Tambah Karyawan</a>
        </div>

        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID Karyawan</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">Departemen</th>
                    <th class="align-middle">Jabatan</th>
                    <th class="align-middle">Tanggal Bergabung</th>
                    <th class="align-middle">Status Karyawan</th>
                    <th class="align-middle">Jenis Kelamin</th>
                    <th class="align-middle">Tempat dan Tanggal Lahir</th>
                    <th class="align-middle">Nomor HP</th>
                    <th class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td class="align-middle">{{ $karyawan->ID_Karyawan }}</td>
                        <td class="align-middle">{{ $karyawan->Nama_Karyawan }}</td>
                        <!-- Menampilkan Nama Departemen dan Nama Jabatan -->
                        <td class="align-middle">{{ $karyawan->departemen->Nama_Departemen }}</td>
                        <td class="align-middle">{{ $karyawan->jabatan->Nama_Jabatan }}</td>
                        <td class="align-middle">{{ $karyawan->Tanggal_Bergabung }}</td>
                        <td class="align-middle">{{ ucfirst($karyawan->Status_Karyawan) }}</td>
                        <td class="align-middle">{{ $karyawan->Jenis_Kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        <td class="align-middle">{{ $karyawan->Tempat_Tanggal_Lahir }}</td>
                        <td class="align-middle">{{ $karyawan->Nomor_HP }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('karyawan.edit', $karyawan->ID_Karyawan) }}"
                                    class="btn btn-warning btn-sm mx-2">Edit</a>
                                <form action="{{ route('karyawan.destroy', $karyawan->ID_Karyawan) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-2"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
