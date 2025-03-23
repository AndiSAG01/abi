<nav class="navbar navbar-expand-lg  ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html"><img src="/assets/images/logo.jpg" alt="" style="width: 100px;" class="rounded-circle"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/') ? 'active' : '' ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="/about" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/about') ? 'active' : '' ?>">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a href="/destination" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/destination') ? 'active' : '' ?>">Destinasi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('/transaction'); ?>">Form Transaksi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('/transactions-table'); ?>">Tabel Transaksi</a></li>
                    </ul>
                </li>

                <?php if (session()->get('logged_in')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('uploads/customers/' . session()->get('image')); ?>"
                                alt="Profile Picture"
                                class="rounded-circle"
                                width="40"
                                height="40"
                                style="object-fit: cover; margin-right: 10px;">
                            <?= session()->get('name'); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('/profile'); ?>">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('/logouts'); ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item mt-4">
                        <a href="<?= base_url('/logins'); ?>" class="btn btn-primary btn-sm">Login</a>
                        <a href="<?= base_url('/register_costumer'); ?>" class="btn btn-success btn-sm">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>