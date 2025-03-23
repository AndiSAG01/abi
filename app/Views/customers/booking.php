<?= $this->extend('layouts/user') ?>

<?= $this->section('content') ?>
<section class="ftco-section ftco-about img" style="background-image: url(/assets/images/booking.jpg);">
</section>

<section class="ftco-section">
    <div class="container">
        <div class="media">
            <img src="<?= base_url('/uploads/tours/'.$tour['image']) ?>" class="mr-3" style="width:150px" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><?= esc($tour['name'])?></h5>
                <span><?= esc($tour['location'])?></span>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>