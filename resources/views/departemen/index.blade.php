@extends('layouts.app')

@section('title', 'Daftar Departemen')

@section('content')
<div class="container">
    <div class="header d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Departemen</h1>
        <a href="{{ route('departemen.create') }}" class="btn btn-primary">Tambah Departemen</a>
    </div>

    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>ID Departemen</th>
                <th>Nama Departemen</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $d)
                <tr>
                    <td>{{ $d->ID_Departemen }}</td>
                    <td>{{ $d->Nama_Departemen }}</td>
                    <td>{{ $d->Deskripsi_Departemen }}</td>
                    <td>
                        <a href="{{ route('departemen.edit', $d->ID_Departemen) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('departemen.destroy', $d->ID_Departemen) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
