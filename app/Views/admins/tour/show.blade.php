@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm">
        <img src="<?= base_url('uploads/tours/' . esc($tour['image'])) ?>" class="img-fluid p-3 " alt="Tour Image">

        <div class="card-body">
            <h2 class="fw-bold"><?= esc($tour['name']) ?></h2>
            <div class="mb-3">
                <div>
                    <?php if (!empty($tour['classification_names'])) : ?>
                        <?php foreach (explode(',', $tour['classification_names']) as $classification) : ?>
                            <span class="badge bg-primary rounded" style="font-size: 20px;"><?= esc(trim($classification)) ?></span>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <span class="text-muted">Tidak ada klasifikasi</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="">
                <h3><i class="fas fa-map-marker-alt"></i> <?= esc($tour['location']) ?></h3>
                <h3 class="mt-3 mb-3"><i class="fas fa-money-bill-wave"></i> <?= "Rp." . number_format($tour['ticket'], 0, ',', '.') ?>/Person</h3>
            </div>



            <div class="mb-3">
                <div><i class="fas fa-check fa-lg"></i>
                    <?php if (!empty($tour['category_names'])) : ?>
                        <?php foreach (explode(',', $tour['category_names']) as $category) : ?>
                            <span class="badge bg-secondary rounded" style="font-size: 20px;"><?= esc(trim($category)) ?></span>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <span class="text-muted">Tidak ada kategori</span>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3 style="font-family: Abril Fatface, serif;">Informasi Detail</h3>
                </div>
                <div class="col-md-6">
                    <?= htmlspecialchars_decode($tour['information_detail']) ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3 style="font-family: Abril Fatface, serif;">Harap Diperhatikan</h3>
                </div>
                <div class="col-md-6">
                    <?= htmlspecialchars_decode($tour['information']) ?>
                </div>
            </div>

            <a href="<?= base_url('admins/tour') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

@endsection