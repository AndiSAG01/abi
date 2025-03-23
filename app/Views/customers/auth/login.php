<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blogger Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <?= view('layouts/font')?>
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
            width: 800px;
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
                <p style="font-size:12px">Masukan Email dan Password Dengan Benar 😉</p>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?= validation_list_errors() ?>

                <?= form_open('logins'); ?>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Masukan Email Anda" aria-label="Email" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Masukan Password Anda" aria-label="Password" aria-describedby="basic-addon1">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Login</button>
                    <span>Sudah Punya Akun? <a href="<?php echo base_url('register_costumer'); ?>">Buat akun</a></span>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>
</body>

</html>