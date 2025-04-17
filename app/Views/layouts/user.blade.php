<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kerinci Smart Tourism</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/css/animate.css">

    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">

    <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/assets/css/jquery.timepicker.css">


    @include('layouts.font')
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: black;
        border-radius: 50%;
        padding: 10px;
    }

    .carousel-controls {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
</style>

<body>

    @include('admins.alert')
    @include('partials.navbar')

    <!-- END nav -->



    @yield('content')


    <section class="ftco-intro ftco-section ftco-no-pt">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="img" style="background-image: url(/assets/images/bg_2.jpg);">
                        <div class="overlay"></div>
                        <h2>Kami Adalah Kerinci Smart Tourism Sebuah Agen Perjalanan</h2>
                        <p>Kami dapat mengelola bangunan impian Anda dan Melayani Anda Dengan Sepenuh Hati</p>
                        <p class="mb-0"><a href="/destination" class="btn btn-primary px-4 py-3">Mulai Perjalan
                                Anda</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(/assets/images/bg_3.jpg);">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md pt-5">
                    <div class="ftco-footer-widget pt-md-5 mb-4">
                        <h2 class="ftco-heading-2">Tentang</h2>
                        <p>Jauh di barat Pulau Sumatra, di kaki Gunung Kerinci yang megah, terbentang sebuah negeri yang
                            kaya akan keindahan alam dan budaya—Kerinci. Dikenal sebagai "Sekepal Tanah Surga," daerah
                            ini menyimpan pesona luar biasa yang memikat siapa saja yang datang mengunjunginya.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md pt-5 border-left">
                    <div class="ftco-footer-widget pt-md-5 mb-4">
                        <h2 class="ftco-heading-2">Pengalaman</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Pertualangan</a></li>
                            <li><a href="#" class="py-2 d-block">Pantai</a></li>
                            <li><a href="#" class="py-2 d-block">Budaya</a></li>
                            <li><a href="#" class="py-2 d-block">Alam</a></li>
                            <li><a href="#" class="py-2 d-block">Berkemah</a></li>
                            <li><a href="#" class="py-2 d-block">Berpesta</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md pt-5 border-left">
                    <div class="ftco-footer-widget pt-md-5 mb-4">
                        <h2 class="ftco-heading-2">Kamu Memiliki Pertanyaan ?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map-marker"></span><span class="text">JR Taman Rindu
                                        Gunung Selasih Semurup, Sekungkung, Depati Tujuh, Kerinci Regency, Jambi 37152,
                                        Indonesia</span></li>
                                <li><a
                                        href="https://api.whatsapp.com/send/?phone=6282181350150&text&type=phone_number&app_absent=0"><span
                                            class="icon fa fa-phone"></span><span class="text">+62
                                            821-8135-0150</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span
                                            class="text">frescotrip@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.easing.1.3.js"></script>
    <script src="/assets/js/jquery.waypoints.min.js"></script>
    <script src="/assets/js/jquery.stellar.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/jquery.animateNumber.min.js"></script>
    <script src="/assets/js/bootstrap-datepicker.js"></script>
    <script src="/assets/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="/assets/js/google-map.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="https://kit.fontawesome.com/be87c3e44a.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>

</body>

</html>
