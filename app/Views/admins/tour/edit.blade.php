@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <div class="card">
        <div class="card-header">
            <h3 style="font-family: Abril Fatface, serif;">Edit Data Kategori</h3>
        </div>
        {{-- @include('admins.alert') --}}
        <div class="card-body">
            <div class="card-body">
                <form action="<?= base_url('admins/tour/update/' . $tour['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $tour['id'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Tour</label>
                                <input type="text" class="form-control" name="name" value="<?= old('name', $tour['name']) ?>" required>
                                <small class="text-danger"><?= session('errors.name') ?></small>
                            </div>

                            <div class="form-group">
                                <label for="my-input">Status</label>
                                <select name="status" class="form-control rounded" required>
                                    <option value="aktif" <?= ($tour['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                    <option value="nonaktif" <?= ($tour['status'] == 'nonaktif') ? 'selected' : '' ?>>NonAktif</option>
                                </select>
                            </div>                            
                    
                            <div class="form-group">
                                <label>Klasifikasi</label>
                                <select name="classification[]" class="form-control select2" multiple required>
                                    <?php foreach ($classifications as $classification) : ?>
                                        <option value="<?= $classification['id'] ?>" <?= in_array($classification['id'], $tourClassifications) ? 'selected' : '' ?>>
                                            <?= $classification['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger"><?= session('errors.classification') ?></small>
                            </div>
                    
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category[]" class="form-control select2" multiple required>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id'] ?>" <?= in_array($category['id'], $tourCategories) ? 'selected' : '' ?>>
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger"><?= session('errors.category') ?></small>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" name="location" value="<?= old('location', $tour['location']) ?>" required>
                                <small class="text-danger"><?= session('errors.location') ?></small>
                            </div>
                    
                            <div class="form-group">
                                <label>Harga Tiket</label>
                                <input type="number" class="form-control" name="ticket" value="<?= old('ticket', $tour['ticket']) ?>" required>
                                <small class="text-danger"><?= session('errors.ticket') ?></small>
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
                                <textarea name="information" id="information" class="form-control"><?= old('information', $tour['information']) ?></textarea>
                                <small class="text-danger"><?= session('errors.information') ?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Informasi Detail</label>
                                <textarea name="information_detail" id="information_detail" class="form-control"><?= old('information_detail', $tour['information_detail']) ?></textarea>
                                <small class="text-danger"><?= session('errors.information_detail') ?></small>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                </form>
            </div>

        </div>
    </div>
</div>
@include('admins.tour.ckeditor')
@endsection