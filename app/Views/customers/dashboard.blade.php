@extends('layouts.user')

@section('content')

<div class="hero-wrap js-fullheight" style="background-image: url('/assets/images/gunung.png');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <span class="subheading">Selamat Datang Di Kerinci Smart Tourism</span>
                <h1 class="mb-4">Temukan Tempat Favorit Anda Bersama Kami</h1>
                <p class="caps">Bepergian ke sudut manapun di dunia, tanpa harus berputar-putar</p>
            </div>
            <a href="https://www.youtube.com/watch?v=X2hTsm4Iz8k" target="_blank" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                <span class="fa fa-play"></span>
            </a>

        </div>
    </div>
</div>

<section class="ftco-section services-section">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                <div class="w-100">
                    <span class="subheading">Welcome to Pacific</span>
                    <h2 class="mb-4">Saatnya memulai petualangan Anda</h2>
                    <p>
                        Kabupaten Kerinci, yang terletak di Provinsi Jambi, adalah surga tersembunyi bagi para pencinta alam. Dengan Gunung Kerinci sebagai puncak tertinggi di Sumatra, pendaki dapat menikmati panorama luar biasa dari ketinggian. Danau Gunung Tujuh menawarkan ketenangan dengan air jernih di tengah pegunungan. Air Terjun Telun Berasap menambah pesona dengan kabut air yang menyegarkan. Wisatawan juga bisa menikmati kebun teh Kayu Aro, salah satu yang tertua di dunia, serta mencicipi kopi khas Kerinci. Budaya dan kuliner khas seperti gulai ikan semah dan lemang semakin melengkapi pengalaman wisata di Kerinci. 🌿🏞️✨
                    </p>
                    <p><a href="#" class="btn btn-primary py-3 px-4">Search Destination</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-1 d-block img" style="background-image: url(/assets/images/paralayang.jpeg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Activities</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-2 d-block img" style="background-image: url(/assets/images/haiking.jpg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Travel Arrangements</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-3 d-block img" style="background-image: url(/assets/images/private.jpg);">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Private Guide</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                        <div class="services services-1 color-4 d-block img" style="background-image: url(/assets/images/danau.png);">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
                            <div class="media-body">
                                <h3 class="heading mb-3">Location Manager</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
