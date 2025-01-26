@extends('layouts.app')

@section('title', 'Tambah Departemen')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Departemen</h1>

    <form action="{{ route('departemen.store') }}" method="POST">
        @csrf <!-- CSRF Token -->

        <!-- Nama Departemen -->
        <div class="mb-3">
            <label for="Nama_Departemen" class="form-label">Nama Departemen</label>
            <input 
                type="text" 
                class="form-control @error('Nama_Departemen') is-invalid @enderror" 
                id="Nama_Departemen" 
                name="Nama_Departemen" 
                value="{{ old('Nama_Departemen') }}" 
                required>
            @error('Nama_Departemen')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Deskripsi Departemen -->
        <div class="mb-3">
            <label for="Deskripsi_Departemen" class="form-label">Deskripsi</label>
            <textarea 
                class="form-control @error('Deskripsi_Departemen') is-invalid @enderror" 
                id="Deskripsi_Departemen" 
                name="Deskripsi_Departemen"
            >{{ old('Deskripsi_Departemen') }}</textarea>
            @error('Deskripsi_Departemen')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('departemen.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
