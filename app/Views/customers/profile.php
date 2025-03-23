<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<section class="ftco-section ftco-about img" style="background-image: url(/assets/images/danau_kaco.jpeg);">
</section>

<section class="ftco-section ftco-about ftco-no-pt img">
    <div class="container mt-2">
        <div class="card shadow-sm">
            <div class="card-header text-dark" style='font-family:Abril Fatface;'>Profile Anda </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/profile/update'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="text-center">
                        <img src="<?= base_url('uploads/customers/' . $customer['image']); ?>"
                            alt="Profile Picture"
                            class="rounded-circle mb-3"
                            width="150"
                            height="150"
                            style="object-fit: cover;">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= esc($customer['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= esc($customer['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password Baru Anda" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="<?= base_url('/'); ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>