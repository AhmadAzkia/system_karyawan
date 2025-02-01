@extends('layouts.app')

@section('title', 'Daftar Departemen')

@section('content')
    <div class="container">
        <div class="header d-flex justify-content-between align-items-center mb-3">
            <h1 class="w-50">Daftar Departemen</h1>

            <form action="{{ route('departemen.index') }}" method="GET" class="d-flex w-45">
                <input type="text" name="search" class="form-control" placeholder="Cari Departemen"
                    value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary ms-2">Cari</button>
            </form>

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
                @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->ID_Departemen }}</td>
                    <td>{{ $department->Nama_Departemen }}</td>
                    <td>{{ $department->Deskripsi_Departemen }}</td>
                    <td>
                        <a href="{{ route('departemen.edit', $department->ID_Departemen) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('departemen.destroy', $department->ID_Departemen) }}" method="POST" style="display:inline-block;">
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
