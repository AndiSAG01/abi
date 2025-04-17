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
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('uploads/tours/' . esc($item['tour_image'])) ?>"
                                                width="60px" class="rounded me-2" alt="Tour Image">
                                            <div class="ml-2">
                                                <strong><?= esc($item['tour_name']) ?></strong>
                                                <p class="mb-0 text-muted">Lokasi: <?= esc($item['tour_location']) ?></p>
                                            </div>
                                        </div>
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
                                        @elseif ($item['status'] == 'Menunggu konfirmasi')
                                            <button class="btn btn-badge btn-info btn-sm">{{ $item['status'] }}</button>
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
                                                <form action="" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Batal</button>
                                                </form>
                                            </div>
                                        @elseif ($item['status'] == 'Menunggu konfirmasi')
                                            <a href="" class="btn btn-warning btn-sm disabled">Menunggu
                                                Konfirmasi</a>
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
@endsection
