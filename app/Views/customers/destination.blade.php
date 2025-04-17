@extends('layouts.user')

@section('content')
    <section class="ftco-section ftco-about img" style="background-image: url(/assets/images/hutan.jpg);">
        <div class="overlay"></div>
        <div class="container py-md-5">
            <div class="row py-md-5">
                <div class="col-md d-flex align-items-center justify-content-center">
                    <a href="https://www.youtube.com/watch?v=X2hTsm4Iz8k"
                        class="d-flex align-items-center justify-content-center mb-4">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Destination</span>
                    <h2 class="mb-4">Tour Destination</h2>
                </div>
            </div>
            <?= view('Myth\Auth\Views\_message_block') ?>
            <div class="row">
                <?php foreach ($tours as $tour): ?>
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <div class="position-relative">
                            <a class="img d-block"
                                style="background-image: url('<?= base_url('uploads/tours/' . $tour['image']) ?>'); 
                           background-size: cover; height: 250px; border-radius: 10px; position: relative;">

                                <!-- Label Status -->
                                <span class="badge bg-success ml-2 mt-2 p-2 text-white">
                                    <?= esc($tour['status']) ?>
                                </span>

                                <!-- Harga Tiket -->
                                <span class="badge bg-primary position-absolute text-white bottom-0 end-0 m-2 p-2">
                                    <?= 'Rp.' . number_format($tour['ticket'], 0, ',', '.') ?>/person
                                </span>
                            </a>
                        </div>

                        <div class="text p-4">
                            <h3 style="font-family: 'Abril Fatface', serif;">
                                <a href="<?= base_url('/destination/detail/' . $tour['id']) ?>">
                                    <?= esc($tour['name']) ?>
                                </a>
                            </h3>
                            <p class="location">
                                <i class="fa fa-map-marker"></i> <?= esc($tour['location']) ?>
                            </p>

                            <!-- Tombol Booking & Detail -->
                            <div class="d-flex">
                                <form action="<?= base_url('/transactions/add') ?>" method="post" style="margin: 2px;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="tour_id" value="<?= esc($tour['id']) ?>">
                                    <input type="hidden" name="user_id" value="<?= esc(session()->get('id')) ?>">
                                    <?php if (session()->get('logged_in')): ?>
                                    <button type="submit" class="btn btn-primary">
                                        Add to List <i class="fas fa-plus"></i>
                                    </button>
                                    <?php else: ?>
                                    <a href="/login" class="btn btn-secondary text-white">
                                        Login
                                    </a>
                                    <?php endif; ?>
                                </form>

                                <a href="<?= base_url('/destination/detail/' . $tour['id']) ?>" class="btn btn-info">
                                    Detail <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
@endsection
