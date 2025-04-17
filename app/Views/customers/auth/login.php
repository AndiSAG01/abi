<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blogger Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(125deg, rgba(255, 175, 0, 1) 0%, rgba(255, 175, 0, 1) 33%, rgba(255, 255, 255, 0) 33%), url('/admin/images/gunung.png') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
        }

        .login-box {
            display: flex;
            flex-direction: row;
            width: 800px;
            max-width: 90%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .login-image {
            width: 50%;
            background: url('/admin/images/logo.jpg') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .login-form {
            width: 50%;
            padding: 40px;
            background: #1e3d7d;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .btn-login {
            width: 100%;
            background: white;
            color: #1e3d7d;
            font-weight: bold;
        }

        /* Mode Mobile */
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
            </div>
            <div class="login-form">
                <h3 class="mb-4">TOUR BLOGGER</h3>
                <p style="font-size:12px">Masukan Email dan Password Dengan Benar 😉</p>
                <?= view('Myth\Auth\Views\_message_block') ?>

                <form action="<?= route_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.login') ?>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login">Login</button>
                </form>
                <p class="mt-2">Belum Punya Akun? <a href="<?php echo base_url('register'); ?>">Buat akun</a></p>
                <a href="<?= url_to('forgot') ?>" class="text-white">Lupa Password?</a>
            </div>
        </div>
    </div>
</body>

</html>