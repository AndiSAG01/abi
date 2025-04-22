@extends('layouts.user')

@section('content')
    <section class="ftco-section ftco-about img" style="background-image: url(/assets/images/masurai.png);">
        <div class="overlay"></div>
    </section>
    <section class="ftco-section ftco-no-pb contact-section mb-4 p-3">
        <div class="card shadow-lg border-0 rounded-4">
            <h3 class="card-header text-center bg-primary text-white py-3 rounded-top-4"
                style="font-family: 'Abril Fatface', cursive;">
                Tabel Transaksi Tour
            </h3>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Destinasi</th>
                                <th scope="col">Tanggal Berangkat</th>
                                <th scope="col">Tanggal Kepulangan</th>
                                <th scope="col">Jumlah Peserta</th>
                                <th scope="col">Item</th>
                                <th scope="col">Subtotal Pembayaran</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>
                                        <ul class="list-unstyled d-flex flex-column">
                                            @foreach ($item['tours'] as $tour)
                                                <li class="d-flex align-items-center mb-2">
                                                    <img src="{{ base_url('uploads/tours/' . esc($tour['image'])) }}"
                                                        width="60px" class="rounded me-2" alt="Tour Image">
                                                    <div>
                                                        <strong>{{ esc($tour['name']) }}</strong><br>
                                                        <span class="text-muted">Lokasi: {{ esc($tour['location']) }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $item['start_date'] }}</td>
                                    <td>{{ $item['end_date'] }}</td>
                                    <td>{{ $item['total_people'] }}</td>
                                    <td>
                                        @php
                                            $items = explode(',', $item['items_names']); // Pisah nama item
                                            $qtys = explode(',', $item['qty']); // Pisah qty
                                        @endphp
                                        <ul>
                                            @foreach ($items as $index => $item_name)
                                                <li>{{ $item_name }} - {{ $qtys[$index] ?? 0 }} pcs</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>Rp. {{ number_format($item['amount']) }}</td>
                                    <td>
                                        @if ($item['status'] == 'Pending')
                                            <button class="btn btn-badge btn-danger btn-sm">{{ $item['status'] }}</button>
                                        @elseif ($item['status'] == 'Menunggu Konfirmasi')
                                            <button class="btn btn-badge btn-info btn-sm">{{ $item['status'] }}</button>
                                        @elseif ($item['status'] == 'Sedang Berjalan')
                                            <button class="btn btn-badge btn-info btn-sm">Konfirmasi Berhasil</button>
                                        @elseif($item['status'] == 'Selesai')
                                            <button class="btn btn-badge btn-success btn-sm">{{ $item['status'] }}</button>
                                        @else
                                            <button class="btn btn-badge btn-danger btn-sm">{{ $item['status'] }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['status'] == 'Pending')
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ 'transaction-pay/' . $item['id'] }}"
                                                    class="btn btn-info btn-sm mr-1">Pembayaran</a>
                                                <button class="btn btn-danger btn-sm btn-delete"
                                                    data-id="<?= $item['id'] ?>">
                                                    Batal
                                                </button>
                                            </div>
                                        @elseif ($item['status'] == 'Menunggu Konfirmasi')
                                            <a href="" class="btn btn-warning btn-sm disabled">Menunggu
                                                Konfirmasi</a>
                                        @elseif ($item['status'] == 'Sedang Berjalan')
                                            <a href="{{ base_url('unduh-kwitansi/' . $item['id']) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="far fa-file-pdf"></i> Unduh Kwitansi
                                            </a>
                                        @elseif($item['status'] == 'Selesai')
                                            <a href="" class="btn btn-success btn-sm disabled">Selesai</a>
                                        @else
                                            <a href="" class="btn btn-danger btn-sm disabled">Dibatalkan</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <script src="/admin/vendors/sweetalert/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".btn-delete").forEach(function(button) {
                button.addEventListener("click", function() {
                    let categoryId = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data akan dihapus secara permanen!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Batalkan!",
                        cancelButtonText: "Keluar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href =
                                "<?= base_url('/transaction/delete/') ?>" + categoryId;
                        }
                    });
                });
            });
        });
    </script>
@endsection
