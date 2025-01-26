@extends('layouts.app')

@section('title', 'Tambah Jabatan')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Jabatan</h1>

    <form action="{{ route('jabatan.store') }}" method="POST">
        @csrf <!-- CSRF Token -->

        <!-- Nama Jabatan -->
        <div class="mb-3">
            <label for="Nama_Jabatan" class="form-label">Nama Jabatan</label>
            <input
                type="text"
                class="form-control @error('Nama_Jabatan') is-invalid @enderror"
                id="Nama_Jabatan"
                name="Nama_Jabatan"
                value="{{ old('Nama_Jabatan') }}"
                required>
            @error('Nama_Jabatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Deskripsi Jabatan -->
        <div class="mb-3">
            <label for="Deskripsi_Jabatan" class="form-label">Deskripsi</label>
            <textarea
                class="form-control @error('Deskripsi_Jabatan') is-invalid @enderror"
                id="Deskripsi_Jabatan"
                name="Deskripsi_Jabatan"
            >{{ old('Deskripsi_Jabatan') }}</textarea>
            @error('Deskripsi_Jabatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Gaji Min -->
        <div class="mb-3">
            <label for="Min_Gaji" class="form-label">Gaji Min</label>
            <input
                type="number"
                class="form-control @error('Min_Gaji') is-invalid @enderror"
                id="Min_Gaji"
                name="Min_Gaji"
                value="{{ old('Min_Gaji') }}"
                required>
            @error('Min_Gaji')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Gaji Max -->
        <div class="mb-3">
            <label for="Max_Gaji" class="form-label">Gaji Max</label>
            <input
                type="number"
                class="form-control @error('Max_Gaji') is-invalid @enderror"
                id="Max_Gaji"
                name="Max_Gaji"
                value="{{ old('Max_Gaji') }}"
                required>
            @error('Max_Gaji')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- ID Departemen -->
        <div class="mb-3">
            <label for="ID_Departemen" class="form-label">Departemen</label>
            <select
                class="form-control @error('ID_Departemen') is-invalid @enderror"
                id="ID_Departemen"
                name="ID_Departemen"
                required>
                <option value="" disabled selected>Pilih Departemen</option>
                @foreach($departemen as $d)
                    <option value="{{ $d->ID_Departemen }}" {{ old('ID_Departemen') == $d->ID_Departemen ? 'selected' : '' }}>
                        {{ $d->Nama_Departemen }}
                    </option>
                @endforeach
            </select>
            @error('ID_Departemen')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
