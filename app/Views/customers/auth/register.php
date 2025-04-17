<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blogger Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: rgb(255, 175, 0);
            background: linear-gradient(125deg, rgba(255, 175, 0, 1) 0%, rgba(255, 175, 0, 1) 33%, rgba(255, 255, 255, 0) 33%), url('/admin/images/gunung.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }


        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            display: flex;
            width: 80%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-image {
            width: 50%;
            background: url('/admin/images/logo.jpg') no-repeat center center/cover;
            position: relative;
        }

        .login-image::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .login-image-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 1;
        }

        .login-form {
            width: 50%;
            padding: 40px;
            background: #1e3d7d;
            color: white;
        }

        .social-icons i {
            font-size: 20px;
            margin: 10px;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            background: white;
            color: #1e3d7d;
            font-weight: bold;
        }

        @media (max-width: 767px) {
            .login-box {
                flex-direction: column;
                max-width: 400px;
                align-items: center;
            }

            .login-image {
                width: 100%;
                height: 200px;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .login-form {
                width: 100%;
                padding: 20px;
            }
        }

        .form-control {
            font-size: 14px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-image">
                <div class="login-image-text"></div>
            </div>
            <div class="login-form">
                <h3 class="mb-4" style="font-family: Abril Fatface, serif;">TOUR BLOGGER</h3>
                <p style="font-size:13px">Masukan Data Identitas Dengan <span class="text-success">Benar</span> agar
                    tidak terjadi <span class="text-danger">Kesalahan</span> Informasi 😉</p>

                    <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= base_url('register') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Nama</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>"
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>" required>
                                </div>
                                <?php if (isset($errors['email'])) : ?>
                                    <small class="text-danger"><?= esc($errors['email']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="telphone">Nomor Telepon</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    <input type="number" class="form-control <?php if (session('errors.telphone')) : ?>is-invalid<?php endif ?>" name="telphone" id="telphone"placeholder="Masukan Nomor Telphone Anda" value="<?= old('telphone') ?>"
                                        pattern="[0-9]+" title="Masukkan hanya angka" required>
                                </div>
                                <?php if (isset($errors['telphone'])) : ?>
                                    <small class="text-danger"><?= esc($errors['telphone']) ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Minimal 8 karakter" minlength="8" title="Minimal 8 karakter"
                                        required>
                                </div>
                                <?php if (isset($errors['password'])) : ?>
                                    <small class="text-danger"><?= esc($errors['password']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="image">Foto (Opsional)</label>
                            <input type="file" name="image" id="image" class="form-control <?php if (session('errors.image')) : ?>is-invalid<?php endif ?>" accept="image/*"
                                onchange="previewImage(event)">
                            <img id="imagePreview" src="" alt="Preview Gambar"
                                style="display:none; max-width:100px; margin-top:10px;">
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Register</button>
                        <span> Sudah Punya Akun? Silahkan <a href="<?= base_url('login') ?>">Login</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>
</body>

</html>