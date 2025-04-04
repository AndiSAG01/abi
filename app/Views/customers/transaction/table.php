<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>

<section class="ftco-section ftco-about img" style="background-image: url(/assets/images/masurai.png);">
    <div class="overlay"></div>
</section>
<section class="ftco-section ftco-no-pb contact-section mb-4 p-3">
    <div class="card shadow-lg border-0 rounded-4">
        <h3 class="card-header text-center bg-primary text-white py-3 rounded-top-4" style="font-family: 'Abril Fatface', cursive;">
            Tabel Transaksi Tour
        </h3>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Destinasi</th>
                            <th scope="col">Tanggal Berangkat</th>
                            <th scope="col">Tanggal Kepulangan</th>
                            <th scope="col">Jumlah Peserta</th>
                            <th scope="col">Item</th>
                            <th scope="col">Subtotal Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $key => $item) : ?>
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url('uploads/tours/' . esc($item['tour_image'])) ?>" width="60px" class="rounded me-2" alt="Tour Image">
                                        <div class="ml-2">
                                            <strong><?= esc($item['tour_name']) ?></strong>
                                            <p class="mb-0 text-muted">Lokasi: <?= esc($item['tour_location']) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td></td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

<?= $this->endsection() ?>