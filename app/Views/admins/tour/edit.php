<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container py-3">
    <div class="card">
        <div class="card-header">
            <h3 style="font-family: Abril Fatface, serif;">Edit Data Kategori</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <form action="<?= base_url('admins/tour/update/' . $tour['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $tour['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Tour</label>
                                <input type="text" class="form-control" name="name" value="<?= $tour['name'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Klasifikasi</label>
                                <select name="classification[]" class="form-control select2" multiple="multiple" required>
                                    <?php foreach ($classifications as $classification) : ?>
                                        <option value="<?= $classification['id'] ?>" <?= in_array($classification['id'], $tourClassifications) ? 'selected' : '' ?>>
                                            <?= $classification['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category[]" class="form-control select2" multiple="multiple" required>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id'] ?>" <?= in_array($category['id'], $tourCategories) ? 'selected' : '' ?>>
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" name="location" value="<?= $tour['location'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Harga Tiket</label>
                                <input type="number" class="form-control" name="ticket" value="<?= $tour['ticket'] ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" class="form-control" name="image">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-danger">Biarkan kosong jika tidak ingin mengganti foto.</small>
                                    <?php if (!empty($tour['image'])) : ?>
                                        <br>
                                        <img src="<?= base_url('/uploads/tours/' . $tour['image']) ?>" alt="Foto Tour" width="100">
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Informasi</label>
                                <textarea name="information" id="information" class="form-control"><?= $tour['information'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Informasi Detail</label>
                                <textarea name="information_detail" id="information_detail" class="form-control"><?= $tour['information_detail'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                </form>
            </div>

        </div>
    </div>
</div>
<?= view('admins/tour/ckeditor') ?>
<?= $this->endSection() ?>