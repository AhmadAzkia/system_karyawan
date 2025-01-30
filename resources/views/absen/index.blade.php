@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lihat Absen</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Absen</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absen as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->karyawan->nama }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->jam_masuk }}</td>
                <td>{{ $data->jam_keluar ?? '-' }}</td>
                <td>
                    @if($data->status == 'Hadir')
                        <span class="badge bg-success">Hadir</span>
                    @elseif($data->status == 'Izin')
                        <span class="badge bg-warning">Izin</span>
                    @else
                        <span class="badge bg-danger">Alpa</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
