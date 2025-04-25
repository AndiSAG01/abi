<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


<?php $session = session(); ?>

<?php if($session->getFlashdata('success')): ?>
<script>
    toastr.success('<?= esc($session->getFlashdata('success')) ?>');
</script>
<?php elseif($session->getFlashdata('error')): ?>
<script>
    toastr.error('<?= esc($session->getFlashdata('error')) ?>');
</script>
<?php elseif($session->getFlashdata('info')): ?>
<script>
    toastr.info('<?= esc($session->getFlashdata('info')) ?>');
</script>
<?php elseif($session->getFlashdata('warning')): ?>
<script>
    toastr.warning('<?= esc($session->getFlashdata('warning')) ?>');
</script>
<?php endif; ?>

<?php if ($session->getFlashdata('errors')): ?>
<script>
    <?php foreach ($session->getFlashdata('errors') as $error): ?>
    toastr.error('<?= esc($error) ?>');
    <?php endforeach; ?>
</script>
<?php endif; ?>
