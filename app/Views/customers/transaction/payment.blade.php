@extends('layouts.user')

@section('content')
    <!-- Hero Section -->
    <section class="ftco-section ftco-about img"
        style="background-image: url(/assets/images/masurai.png); height: 300px; background-size: cover; background-position: center;">
        <div class="overlay" style="background-color: rgba(0,0,0,0.4); height: 100%;"></div>
    </section>
    
    <section class="ftco-section ftco-no-pb contact-section mb-5 p-3">
        <div class="container">
            <div class="card shadow-sm rounded border-0">
                <div class="card-body p-4">
                    <h4 class="mb-4 text-center font-weight-bold text-primary">Upload Bukti Pembayaran</h4>

                    <!-- Bank Info -->
                    <div class="row">
                        @foreach ($bank as $banks)
                            <div class="col-md-6 mb-4">
                                <div
                                    class="border rounded p-3 bg-light h-100 d-flex flex-column align-items-center text-center">
                                    <img src="{{ site_url('uploads/banks/'.$banks['image']) }}" alt="Logo BCA" class="img-fluid mb-2"
                                        style="max-height: 100px;">
                                    <h5 class="mb-0 font-weight-bold">{{ $banks['name'] }}</h5>
                                    <p class="text-muted mb-0">No. Rekening: <strong>{{ $banks['account_number'] }}</strong></p>
                                    <p class="text-muted">a.n. PT Masurai Trans</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Upload Form -->
                    <form action="{{ site_url('payment/store') }}" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Hidden transaction_id -->
                        <input type="hidden" name="transaction_id" value="{{ $transaction['id'] }}">

                        <div class="row">
                            <!-- Input Upload -->
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="image">Upload Bukti Pembayaran</label>
                                    <input type="file" name="image" id="image" class="form-control"
                                        accept="image/*" onchange="previewImage(event)" required>
                                    @if (session('error')['image'] ?? false)
                                        <small class="text-danger">{{ session('error')['image'] }}</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Preview Gambar -->
                            <div class="col-md-6 mb-4 text-center">
                                <div class="border rounded p-3 bg-light">
                                    <img src="https://via.placeholder.com/250x150?text=Preview" alt="Preview Gambar"
                                        class="img-fluid rounded" id="preview2" style="max-height: 200px; cursor: pointer;"
                                        data-toggle="modal" data-target="#previewModal">
                                    <p class="mt-2 text-muted">Klik gambar untuk memperbesar</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success w-100">Kirim Bukti Pembayaran</button>
                        </div>
                    </form>


                    <!-- Modal untuk perbesar gambar -->
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
    </section>
    <script>
        function previewImage(event) {
            var output = document.getElementById('preview2');
            var modalImage = document.getElementById('modalPreviewImage');

            const file = event.target.files[0];
            const url = URL.createObjectURL(file);

            output.src = url;
            modalImage.src = url;

            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
        }
    </script>
@endsection
