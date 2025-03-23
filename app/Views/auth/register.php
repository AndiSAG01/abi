<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regis</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center" style="font-weight: bold;">REGISTER</h4>
                                    <hr>
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger">
                                            <?php echo session()->getFlashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?= validation_list_errors() ?>

                                    <?= form_open('register'); ?>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Register</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>

                            </div>
                            <div class="text-center mt-2">
                                Sudah punya akun? <a href="<?php echo base_url('login'); ?>">Silakan login.</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>