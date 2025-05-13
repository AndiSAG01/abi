@extends('layouts.user')

@section('content')
    <!-- Hero Section -->
    <section class="ftco-section ftco-about img"
        style="background-image: url(/assets/images/masurai.png); height: 300px; background-size: cover; background-position: center;">
        <div class="overlay" style="background-color: rgba(0,0,0,0.4); height: 100%;"></div>
    </section>

    <section class="ftco-section contact-section mb-5 p-3">
        <div class="container">
            <div class="card shadow-lg rounded border-0">
                <div class="card-body p-5">
                    <h3 class="text-center text-primary mb-4 font-weight-bold">Upload Bukti Pembayaran</h3>

                    <!-- Info Rekening Bank -->
                    <div class="row justify-content-center mb-4">
                        @foreach ($bank as $banks)
                            <div class="col-md-5 col-sm-10 mb-4">
                                <div
                                    class="bg-white border rounded shadow-sm text-center p-4 h-100 hover-shadow transition">
                                    <img src="{{ site_url('uploads/banks/' . $banks['image']) }}" alt="{{ $banks['name'] }}"
                                        class="img-fluid mb-3" style="max-height: 80px;">
                                    <h5 class="font-weight-bold mb-1">{{ $banks['name'] }}</h5>
                                    <p class="mb-0 text-muted">No. Rekening: <strong>{{ $banks['account_number'] }}</strong>
                                    </p>
                                    <small class="text-muted">a.n. PT Masurai Trans</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Form Upload -->
                    <form action="{{ site_url('payment/store') }}" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="transaction_id" value="{{ $transaction['id'] }}">

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    @if ($isFirstPayment)
                                        <label class="font-weight-bold text-dark">DP yang harus dibayar (20%)</label>
                                        <input type="text" class="form-control"
                                            value="Rp. {{ number_format($dp, 0, ',', '.') }}" disabled>
                                        <label class="font-weight-bold text-dark">Pembayaran Keseluruhan</label>
                                        <input type="text" class="form-control"
                                            value="Rp. {{ number_format($total, 0, ',', '.') }}" disabled>
                                    @else
                                        <label class="font-weight-bold text-dark">Sisa Pembayaran</label>
                                        <input type="text" class="form-control"
                                            value="Rp. {{ number_format($sisaPembayaran, 0, ',', '.') }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Nominal Pembayaran</label>
                                    <input type="number" name="nominal" class="form-control"
                                        placeholder="Masukkan nominal pembayaran Anda" required>
                                    @if (session('error')['nominal'] ?? false)
                                        <small class="text-danger">{{ session('error')['nominal'] }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Upload Bukti Pembayaran</label>
                                    <input type="file" name="image" class="form-control" accept="image/*"
                                        onchange="previewImage(event)" required>
                                    @if (session('error')['image'] ?? false)
                                        <small class="text-danger">{{ session('error')['image'] }}</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Preview Image -->
                            <div class="col-md-6 text-center mb-4">
                                <div class="bg-light rounded p-3 border">
                                    <img src="https://via.placeholder.com/250x150?text=Preview" alt="Preview Gambar"
                                        class="img-fluid rounded" id="preview2" style="max-height: 200px; cursor: pointer;"
                                        data-toggle="modal" data-target="#previewModal">
                                    <p class="mt-2 text-muted">Klik gambar untuk memperbesar</p>
                                </div>
                            </div>

                            <!-- Alert Note -->
                            <div class="col-md-12">
                                <div class="alert alert-warning shadow-sm" role="alert">
                                    <strong>Catatan:</strong> Anda diwajibkan membayar minimal <strong>20% dari sisa
                                        pembayaran</strong> sebagai <strong>DP (uang muka)</strong>.
                                    Apabila pembatalan dilakukan setelah pembayaran, maka <strong>DP tidak dapat
                                        dikembalikan
                                        (hangus)</strong>.
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100">Kirim Bukti Pembayaran</button>
                        </div>
                    </form>

                    <!-- Modal Preview -->
                    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog"
                        aria-labelledby="previewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content bg-transparent border-0">
                                <div class="modal-body text-center">
                                    <img src="https://via.placeholder.com/250x150?text=Preview" class="img-fluid rounded"
                                        id="modalPreviewImage">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .hover-shadow:hover {
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.15) !important;
            }

            .transition {
                transition: 0.3s all ease-in-out;
            }
        </style>

        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                const url = URL.createObjectURL(file);
                document.getElementById('preview2').src = url;
                document.getElementById('modalPreviewImage').src = url;

                document.getElementById('preview2').onload = () => {
                    URL.revokeObjectURL(url);
                };
            }
        </script>
    </section>
@endsection
