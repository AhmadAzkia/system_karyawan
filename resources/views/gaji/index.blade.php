@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header d-flex justify-content-between align-items-center mb-3">
            <h2 class="w-50">Daftar Gaji Karyawan</h2>

            <!-- Form Pencarian -->
            <form action="{{ route('gaji.index') }}" method="GET" class="d-flex w-45">
                <input type="text" name="search" class="form-control" placeholder="Cari Karyawan"
                    value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary ms-2">Cari</button>
            </form>

            <form action="{{ route('gaji.create') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary">Tambah Gaji</button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id_gaji</th>
                    <th>ID Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Gaji Min</th>
                    <th>Gaji Max</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gaji as $data)
                    <tr>
                        <td>{{ $data->ID_Gaji }}</td>
                        <td>{{ $data->ID_Karyawan }}</td>
                        <td>{{ $data->karyawan->Nama_Karyawan ?? 'Tidak Diketahui' }}</td>
                        <td>Rp {{ number_format($data->Gaji_Pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($data->Tunjangan, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('gaji.edit', $data->ID_Gaji) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('gaji.destroy', $data->ID_Gaji) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
