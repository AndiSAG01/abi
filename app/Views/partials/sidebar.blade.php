<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item sidebar-category">
            <p>Navigation</p>
            <span></span>
        </li>
        <li class="nav-item <?= set_active('/admins-index') ?>">
            <a class="nav-link" href="<?= base_url('/admins-index') ?>">
                <i class="mdi mdi-view-quilt menu-icon"></i>
                <span class="menu-title">Beranda</span>
            </a>
        </li>
        <li class="nav-item <?= set_active('/admins/pelanggan') ?>">
            <a class="nav-link" href="<?= base_url('/admins/pelanggan') ?>">
                <i class="fas fa-users menu-icon fa-xs"></i>
                <span class="menu-title">Data Pelanggan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="fab fa-usps menu-icon fa-xs"></i>
                <span class="menu-title">Master Data Tour</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item <?= set_active('/admins/item') ?>"> <a class="nav-link" href="/admins/item">Item
                            <i class="fas fa-cubes fa-xs" style="margin-left:5px"></i></a></li>
                    <li class="nav-item <?= set_active('/admins/klasifikasi') ?>"> <a class="nav-link"
                            href="/admins/klasifikasi">klasifikasi <i class="fas fa-list fa-xs"
                                style="margin-left:5px"></i></a></li>
                    <li class="nav-item <?= set_active('/admins/kategori') ?>"> <a class="nav-link"
                            href="/admins/kategori">Kategori <i class="fas fa-folder fa-xs"
                                style="margin-left:5px"></i></a></li>
                    <li class="nav-item <?= set_active('/admins/tour') ?>"> <a class="nav-link" href="/admins/tour">Tour
                            <i class="fas fa-caravan fa-xs" style="margin-left:5px"></i></a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-transaction" aria-expanded="false"
                aria-controls="ui-transaction">
                <i class="fas fa-chart-line menu-icon fa-xs"></i>
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
            </a>
            @php
                $model = new \App\Models\Transaction();
                $waitingCount = $model->where('status', 'Menunggu Konfirmasi')->countAllResults();
                $waitingCountOtw = $model->where('status', 'Sedaqng Berjalan')->countAllResults();
            @endphp
            <div class="collapse" id="ui-transaction">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item <?= set_active('/transaction-admin') ?>">
                        <a class="nav-link d-flex justify-content-between align-items-center" href="/transaction-admin">
                            <span>Konfirmasi <i class="fas fa-check fa-xs ms-1"></i></span>
                            <?php if (!empty($waitingCount)) : ?>
                            <span class="badge bg-danger rounded-pill"><?= $waitingCount ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item <?= set_active('/transaction-admin/Sedang-Dalam-Perjalanan') ?>">
                        <a class="nav-link d-flex justify-content-between align-items-center" href="/transaction-admin/Sedang-Dalam-Perjalanan">
                            <span>Sendang Berjalan <i class="fas fa-shipping-fast fa-xs ms-1"></i></span>
                            <?php if (!empty($waitingCountOtw)) : ?>
                            <span class="badge bg-danger rounded-pill"><?= $waitingCountOtw ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item <?= set_active('/transaction-admin/Selesai') ?>"> <a class="nav-link"
                            href="/transaction-admin/Selesai">Selesai <i class="fas fa-check-double fa-xs"
                                style="margin-left:5px"></i></a></li>
                    <li class="nav-item <?= set_active('/transaction-admin/Dibatalkan') ?>"> <a class="nav-link"
                            href="/transaction-admin/Dibatalkan">Dibatalkan <i class="fas fa-window-close"
                                style="margin-left:5px"></i></a></li>   
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-report" aria-expanded="false"
                aria-controls="ui-report">
                <i class="fas fa-book menu-icon fa-xs"></i>
                <span class="menu-title">Laporan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item <?= set_active('/Laporan-pelanggan') ?>"> <a class="nav-link" href="/Laporan-pelanggan">Pelanggan <i
                                class="fas fa-users fa-xs" style="margin-left:5px"></i> </a></li>
                    <li class="nav-item <?= set_active('/Laporan-transaksi') ?>"> <a class="nav-link" href="/Laporan-transaksi">Transaksi <i
                                class="fas fa-sticky-note fa-xs" style="margin-left:5px"></i></a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
