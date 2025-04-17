@extends('layouts.admin')

@section('content')
<div class="container py-2">
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <h5 class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    Data Pelanggan <i class="fas fa-users"></i>
                </h5>
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Pelanggan</h5>
                    <p class="display-4 fw-bold text-primary">{{ $customer }}</p>
                    <p class="card-text">Total pelanggan yang terdaftar dalam sistem.</p>
                    <a href="/admins/pelanggan" class="btn btn-success"><i class="fas fa-eye"></i> Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <h5 class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    Data Tour <i class="fab fa-usps"></i>
                </h5>
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Tour</h5>
                    <p class="display-4 fw-bold text-primary">{{ $tour }}</p>
                    <p class="card-text">Total Tour yang terdaftar dalam sistem.</p>
                    <a href="/admins/tour" class="btn btn-success"><i class="fas fa-eye"></i> Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg">
                <h5 class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    Data Transaksi <i class="fas fa-chart-line"></i>
                </h5>
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Transaksi</h5>
                    <p class="display-4 fw-bold text-primary">{{ $transaction }}</p>
                    <p class="card-text">Total Transaksi yang terdaftar dalam sistem.</p>
                    <a href="/transaction-admin/Selesai" class="btn btn-success"><i class="fas fa-eye"></i> Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                Grafik Transaksi Selesai per Bulan
            </div>
            <div class="card-body">
                <canvas id="transactionChart" width="100%"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script> 
    const ctx = document.getElementById('transactionChart').getContext('2d');

    // Data dummy (contoh bulan dan jumlah transaksi)
    const months = {!! $months !!};
    const counts = {!! $counts !!};

    const transactionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Transaksi Selesai',
                data: counts,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.4, // Buat garis agak melengkung
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Transaksi'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
{{-- <script>
    const ctx = document.getElementById('transactionChart').getContext('2d');
    const transactionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $months !!},
            datasets: [{
                label: 'Transaksi Selesai',
                data: {!! $counts !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Transaksi'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            }
        }
    });
</script> --}}
@endsection
