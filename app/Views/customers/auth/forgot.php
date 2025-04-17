<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Travel Blogger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(125deg, rgba(255, 175, 0, 0.9) 0%, rgba(255, 175, 0, 0.9) 33%, rgba(255, 255, 255, 0) 33%), 
                        url('/admin/images/gunung.png') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login-box {
            display: flex;
            flex-direction: row;
            width: 800px;
            max-width: 95%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .login-image {
            width: 50%;
            background: url('/admin/images/logo.jpg') no-repeat center center/cover;
        }

        .login-form {
            width: 50%;
            padding: 40px 30px;
            background: #1e3d7d;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h3 {
            margin-bottom: 25px;
            font-weight: bold;
        }

        .form-control {
            font-size: 14px;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-login {
            background: #ffffff;
            color: #1e3d7d;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #f1f1f1;
            transform: scale(1.02);
        }

        .form-icon {
            position: absolute;
            top: 10px;
            left: 12px;
            color: #999;
        }

        .form-input-icon {
            position: relative;
        }

        .form-input-icon input {
            padding-left: 35px;
        }

        .alert {
            font-size: 14px;
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
                background-size: cover;
            }

            .login-form {
                width: 100%;
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="login-image"></div>
        <div class="login-form">
            <h3><i class="fas fa-unlock-alt me-2"></i>Lupa Password</h3>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif ?>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif ?>

            <form action="<?= url_to('forgot') ?>" method="post">
            <?= csrf_field() ?>
                <div class="form-group form-input-icon">
                    <i class="fas fa-envelope form-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
                </div>
                <button type="submit" class="btn btn-login btn-block mt-2">
                    <i class="fas fa-paper-plane me-1"></i> Kirim Link Reset
                </button>
            </form>
        </div>
    </div>
</body>

</html>
