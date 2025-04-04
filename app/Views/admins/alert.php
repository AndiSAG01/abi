
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success fade show alert-custom" role="alert">
        <?= esc(session()->getFlashdata('success')); ?>
    </div>
<?php endif; ?>

<?php if ($errors = session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger fade show alert-custom" role="alert">
        <ul>
            <?php if (is_array($errors)) : ?>
                <?php foreach ($errors as $err) : ?>
                    <li><?= esc($err); ?></li>
                <?php endforeach; ?>
            <?php else : ?>
                <li><?= esc($errors); ?></li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>

<style>
    .alert-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        width: 300px;
    }

    .alert-custom {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert-custom');
        alerts.forEach(alert => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); // Hapus elemen setelah animasi
        });
    }, 3000); // Hilang setelah 3 detik
</script>