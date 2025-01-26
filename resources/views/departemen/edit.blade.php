@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<div class="container">
    <h1>Edit Departemen</h1>

    <form action="{{ route('departemen.update', $department->ID_Departemen) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Nama_Departemen" class="form-label">Nama Departemen</label>
            <input type="text" class="form-control" id="Nama_Departemen" name="Nama_Departemen"
                   value="{{ $department->Nama_Departemen }}" required>
        </div>

        <div class="mb-3">
            <label for="Deskripsi_Departemen" class="form-label">Deskripsi Departemen</label>
            <textarea class="form-control" id="Deskripsi_Departemen" name="Deskripsi_Departemen">{{ $department->Deskripsi_Departemen }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('departemen.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
