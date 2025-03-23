<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container py-2">
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <h5 class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    Data Pelanggan <i class="fas fa-users"></i>
                </h5>
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Pelanggan</h5>
                    <p class="display-4 fw-bold text-primary">150</p>
                    <p class="card-text">Total pelanggan yang terdaftar dalam sistem.</p>
                    <a href="#" class="btn btn-success"><i class="fas fa-eye"></i> Lihat Detail</a>
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
                    <p class="display-4 fw-bold text-primary">150</p>
                    <p class="card-text">Total Tour yang terdaftar dalam sistem.</p>
                    <a href="#" class="btn btn-success"><i class="fas fa-eye"></i> Lihat Detail</a>
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
                    <p class="display-4 fw-bold text-primary">150</p>
                    <p class="card-text">Total Transaksi yang terdaftar dalam sistem.</p>
                    <a href="#" class="btn btn-success"><i class="fas fa-eye"></i> Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endsection() ?>