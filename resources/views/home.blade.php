@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h2 class="mb-4">Halaman Home</h2>

        <!-- Menampilkan tanggal saat ini -->
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" id="tanggal" class="form-control" value="{{ \Carbon\Carbon::now()->toDateString() }}"
                disabled>
        </div>

        <!-- Menampilkan status kehadiran -->
        <div class="mb-3">
            <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
            <select id="status_kehadiran" class="form-control">
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Alpa">Alpa</option>
            </select>
        </div>

        <!-- Button untuk menuju halaman absensi -->
        <a href="{{ route('absen.create') }}" class="btn btn-primary">Absen Masuk</a>
    </div>
@endsection
