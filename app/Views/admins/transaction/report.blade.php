@extends('layouts.admin')

@section('content')
    <div class="container py-2">
        <div class="card">
            <div class="card-header">
                <h3 style="font-family: Abril Fatface, serif;">Laporan Data Transaksi</h3>
            </div>
            <div class="card-body">

                {{-- Form Filter Tanggal --}}
                <form method="GET" action="{{ site_url('/Laporan-transaksi') }}" class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ $start_date ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ $end_date ?? '' }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ site_url('/Laporan-transaksi') }}" class="btn btn-danger">
                            Reset
                        </a>
                    </div>
                </form>

                {{-- Tombol Export PDF --}}
                <a href="{{ site_url('Laporan/transaksi/pdf?start_date=' . ($start_date ?? '') . '&end_date=' . ($end_date ?? '')) }}"
                    class="btn btn-danger text-white mb-2">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>

                {{-- Tabel Transaksi --}}
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:106%">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Destinasi</th>
                                <th scope="col">Tanggal Berangkat</th>
                                <th scope="col">Tanggal Kepulangan</th>
                                <th scope="col">Jumlah Peserta</th>
                                <th scope="col">Item</th>
                                <th scope="col">Subtotal Pembayaran</th>
                                <th scope="col">Status</th>
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
                                            $items = explode(',', $item['items_names']);
                                            $qtys = explode(',', $item['qty']);
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
                                        @else
                                            <button
                                                class="btn btn-badge btn-success btn-sm disabled">{{ $item['status'] }}</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
