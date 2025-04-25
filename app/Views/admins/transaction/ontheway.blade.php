@extends('layouts.admin')

@section('content')
    <div class="container py-2">
        <div class="card">
            <div class="card-header" style="font-family: Abril Fatface">
                <h3>Transaksi Sedang Berjalan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
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
                                        @elseif ($item['status'] == 'Menunggu konfirmasi')
                                            <button class="btn btn-badge btn-info btn-sm">{{ $item['status'] }}</button>
                                        @else
                                            <button class="btn btn-badge btn-success btn-sm">{{ $item['status'] }}</button>
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
                                        @else
                                            <div class="d-flex">
                                               <form action="{{ site_url('end/'.$item['id']) }}" method="POST">
                                                <button type="submit" class="btn btn-primary btn-sm" style="margin-right: 5px">Selesai</button>
                                            </form>                                               
                                            </div>
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
