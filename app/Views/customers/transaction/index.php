<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>

<section class="ftco-section ftco-about img" style="background-image: url(/assets/images/masurai.png);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-0 bread shadow-lg" style="font-family: Abril Fatface;">Transaksi</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pb contact-section mb-4 p-3">
    <div class="card-body">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container mt-3">
                        <div class="card shadow-lg">
                            <h3 class="card-header bg-primary text-white text-center" style="font-family: 'Abril Fatface', cursive;">List Pilihan Destinasi Tour</h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Deskripsi Tour</th>
                                                <th>Nama Klasifikasi</th>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($transactions as $key => $item) : ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$key ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="<?= base_url('uploads/tours/' . esc($item['tour_image'])) ?>" width="60px" class="rounded me-2" alt="Tour Image">
                                                            <div class="ml-2">
                                                                <strong><?= esc($item['tour_name']) ?></strong>
                                                                <p class="mb-0 text-muted">Lokasi: <?= esc($item['tour_location']) ?></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="mb-0 ps-3">
                                                            <?php foreach (explode(',', $item['classification_names']) as $classification) : ?>
                                                                <li><?= esc(trim($classification)) ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul class="mb-0 ps-3">
                                                            <?php foreach (explode(',', $item['category_names']) as $category) : ?>
                                                                <li><?= esc(trim($category)) ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger btn-delete" data-id="<?= $item['id'] ?>" title="Hapus">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container mt-3">
                        <div class="card shadow-lg">
                            <h3 class="card-header bg-primary text-white text-center" style="font-family: 'Abril Fatface', cursive;">Form Transaksi</h3>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card mb-4">
                                            <h5 class="card-header bg-info text-white text-center">Jadwal Tour</h5>
                                            <div class="card-body">
                                                <div id="calendar"></div>
                                                <div class="nav-buttons">
                                                    <button id="prevMonth" class="btn btn-secondary">Sebelumnya</button>
                                                    <button id="nextMonth" class="btn btn-secondary">Selanjutnya</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-3 bg-light">
                                            <div class="card-body text-center">
                                                <span class="text-danger font-weight-bold">Note:</span>
                                                <p>
                                                    <span class="mr-3">Telah Dibooking <i class="fas fa-square-full" style="color: #ccc;"></i></span>
                                                    <span>Belum Dibooking <i class="fas fa-square-full" style="color: #007bff;"></i></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                                        <form action="#" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="nama" class="font-weight-bold">Nama Lengkap</label>
                                                <input type="text" class="form-control rounded-pill" id="nama" name="customer_id" value="<?= esc($customers['name'] ?? '') ?>" placeholder="Masukkan Nama Lengkap" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="font-weight-bold">Nomor Handphone</label>
                                                <input type="number" class="form-control rounded-pill" id="nama" name="customer_id" value="<?= esc($customers['telphone'] ?? '') ?>" placeholder="Masukkan Nama Lengkap" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="font-weight-bold">Jumlah Peserta</label>
                                                <input type="text" class="form-control rounded-pill" id="no_hp" name="total_people" placeholder="Masukkan Jumlah Peserta" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="font-weight-bold">Tanggal Keberangkatan</label>
                                                <input type="date" class="form-control rounded-pill" id="no_hp" name="start_date" placeholder="Masukkan Nomor Handphone" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp" class="font-weight-bold">Tanggal Kepulangan</label>
                                                <input type="date" class="form-control rounded-pill" id="no_hp" name="end_date" placeholder="Masukkan Nomor Handphone" required>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="card shadow-lg rounded-4">
                            <h3 class="card-header bg-primary text-white text-center" style="font-family: 'Abril Fatface', cursive;">Item Detail</h3>
                            <span class="p-3 text-danger text-center d-block">Note: Item Tidak Wajib Dipilih Jika Tidak Ingin Menambah Perlengkapan</span>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($items as $item) : ?>
                                        <div class="col-6 col-md-4 col-lg-3 mb-3">
                                            <div class="form-check border p-3 rounded shadow-sm bg-light">
                                                <input type="checkbox" class="form-check-input" name="item_id[]" value="<?= esc($item['name']) ?>" id="item-<?= esc($item['id']) ?>">
                                                <label class="form-check-label" for="item-<?= esc($item['id']) ?>">
                                                    <strong><?= esc($item['name']) ?></strong><br>
                                                    <span class="text-muted">Harga: <?= "Rp." . number_format($item['price'], 0, ',', '.') ?></span><br>
                                                    <span class="text-success">Stok: <?= esc($item['stock']) ?></span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success  rounded-pill">Kirim Transaksi</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-controls">
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<?= view('customers/transaction/js') ?>


<?= $this->endsection() ?>