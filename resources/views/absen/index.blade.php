@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Lihat Absen</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>id_absensi</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status Kehadiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absen as $data)
                    <tr>
                        <td>{{ $data->id_absensi }}</td>
                        <td>{{ $data->karyawan ? $data->karyawan->Nama_Karyawan : 'Data tidak ditemukan' }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->jam_masuk }}</td>
                        <td>{{ $data->jam_keluar ?? '-' }}</td>
                        <td class="text-center">
                            @if ($data->status_kehadiran == 'Hadir')
                                <span class="badge bg-success">Hadir</span>
                            @elseif($data->status_kehadiran == 'Izin')
                                <span class="badge bg-warning">Izin</span>
                            @else
                                <span class="badge bg-danger">Alpa</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('absen.edit', $data->id_absensi) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
