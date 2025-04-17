<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blogger Reset Password</title>
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
                <h3 class="mb-4" style="font-family: Abril Fatface, serif;">Reset Password</h3>
                <p style="font-size:13px">Masukan Data Identitas Dengan <span class="text-success">Benar</span> agar
                    tidak terjadi <span class="text-danger">Kesalahan</span> Informasi 😉</p>

                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= url_to('reset-password') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Token</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-signature"></i></span>
                                    <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                </div>
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password"
                                        placeholder="Minimal 8 karakter" minlength="8" title="Minimal 8 karakter"
                                        required>
                                </div>
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Ulangi Password Baru</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" required>
                                </div>
                                <div class="invalid-feedback">
                                    <?= session('errors.pass_confirm') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.resetPassword') ?></button>
                    </div>
                </form>
                <span style="margin-left:220px">Sudah ada Akun? <a href="<?= url_to('login'); ?>" class="btn btn-primary btn-sm btn-block">Login</a></span>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>
</body>

</html>