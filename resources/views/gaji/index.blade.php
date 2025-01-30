@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Daftar Gaji Karyawan</h2>
    <a href="#" class="btn btn-primary mb-3">Tambah Gaji</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
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
                <td>{{ $data->ID_Karyawan }}</td>
                <td>{{ $data->karyawan->Nama_Karyawan ?? 'Tidak Diketahui' }}</td>
                <td>Rp {{ number_format($data->Gaji_Pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($data->Tunjangan, 0, ',', '.') }}</td>
                <td>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <form action="#" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
