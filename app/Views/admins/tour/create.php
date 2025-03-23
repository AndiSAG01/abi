<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="container py-2">
    <div class="card">
        <div class="card-header">Data Baru</div>
        <div class="card-body">
            <form action="<?= base_url('admins/tour/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Tour</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Tour" required>
                        </div>

                        <div class="form-group">
                            <label for="my-input">Status</label>
                            <select name="status" class="form-control rounded" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">NonAktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Klasifikasi</label>
                            <select name="classification[]" class="form-control select2" multiple="multiple" required>
                                <option value="">-- Pilih Klasifikasi --</option>
                                <?php foreach ($classifications as $classification) : ?>
                                    <option value="<?= $classification['id'] ?>"><?= $classification['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category[]" class="form-control select2" multiple="multiple" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="location" placeholder="Masukkan Lokasi" required>
                        </div>

                        <div class="form-group">
                            <label>Harga Tiket</label>
                            <input type="number" class="form-control" name="ticket" placeholder="Masukkan Harga Tiket" required>
                        </div>


                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Informasi</label>
                            <textarea name="information" id="information" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Informasi Detail</label>
                            <textarea name="information_detail" id="information_detail" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>

            </form>
        </div>
    </div>
</div>

<?= view('admins/tour/ckeditor') ?>
<?= $this->endSection() ?>