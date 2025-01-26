@extends('layouts.app')

@section('title', 'Daftar Jabatan')

@section('content')
    <div class="container">
        <div class="header d-flex justify-content-between align-items-center mb-3">
            <h1>Daftar Jabatan</h1>
            <a href="{{ route('jabatan.create') }}" class="btn btn-primary">Tambah Jabatan</a>
        </div>

        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th class="align-middle text-center">ID Jabatan</th>
                    <th class="align-middle text-center">Nama Jabatan</th>
                    <th class="align-middle text-center">Deskripsi</th>
                    <th class="align-middle text-center">Gaji Min</th>
                    <th class="align-middle text-center">Gaji Max</th>
                    <th class="align-middle text-center">ID Departemen</th>
                    <th class="align-middle text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jabatans as $jabatan)
                    <tr>
                        <!-- Menampilkan data jabatan -->
                        <td class="align-middle">{{ $jabatan->ID_Jabatan }}</td>
                        <td class="align-middle">{{ $jabatan->Nama_Jabatan }}</td>
                        <td class="align-middle">{{ $jabatan->Deskripsi_Jabatan }}</td>
                        <td class="align-middle">Rp {{ number_format($jabatan->Min_Gaji, 0, ',', '.') }}</td>
                        <td class="align-middle">Rp {{ number_format($jabatan->Max_Gaji, 0, ',', '.') }}</td>
                        <td class="align-middle">{{ $jabatan->ID_Departemen }}</td>
                        <td class="align-middle d-flex">
                            <!-- Tombol Edit -->
                            <a href="{{ route('jabatan.edit', $jabatan->ID_Jabatan) }}"
                                class="btn btn-warning btn-sm mx-1">Edit</a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('jabatan.destroy', $jabatan->ID_Jabatan) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mx-1"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
