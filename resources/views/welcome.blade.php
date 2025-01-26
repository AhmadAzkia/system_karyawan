@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>

<div class="row">
    <!-- Jumlah Departemen -->
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Departemen</h5>
                <p class="card-text">{{ $total_departemen }}</p>
            </div>
        </div>
    </div>

    <!-- Jumlah Jabatan -->
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Jabatan</h5>
                <p class="card-text">{{ $total_jabatan }}</p>
            </div>
        </div>
    </div>

    <!-- Jumlah Karyawan -->
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Karyawan</h5>
                <p class="card-text">{{ $total_karyawan }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Diagram Karyawan per Departemen -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Karyawan per Departemen</h5>
                <canvas id="chartDepartemen"></canvas>
            </div>
        </div>
    </div>

    <!-- Diagram Rentang Gaji -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Rentang Gaji per Jabatan</h5>
                <canvas id="chartGaji"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Data untuk diagram Karyawan per Departemen
    const departemenLabels = @json($departemen->pluck('Nama_Departemen'));
    const departemenData = @json($departemen->pluck('total_karyawan'));

    // Diagram Lingkaran: Karyawan per Departemen
    new Chart(document.getElementById('chartDepartemen'), {
        type: 'pie',
        data: {
            labels: departemenLabels,
            datasets: [{
                data: departemenData,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
            }]
        }
    });

    // Data untuk diagram Rentang Gaji
    const jabatanLabels = @json($jabatan->pluck('Nama_Jabatan'));
    const minGajiData = @json($jabatan->pluck('Min_Gaji'));
    const maxGajiData = @json($jabatan->pluck('Max_Gaji'));

    // Diagram Garis: Rentang Gaji per Jabatan
    new Chart(document.getElementById('chartGaji'), {
        type: 'line',
        data: {
            labels: jabatanLabels,
            datasets: [
                {
                    label: 'Min Gaji',
                    data: minGajiData,
                    borderColor: '#FF6384',
                    fill: false,
                },
                {
                    label: 'Max Gaji',
                    data: maxGajiData,
                    borderColor: '#36A2EB',
                    fill: false,
                }
            ]
        }
    });
</script>
@endsection
