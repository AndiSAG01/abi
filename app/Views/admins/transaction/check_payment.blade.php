@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="card border-0 shadow-lg rounded-4">
            @if ($payments && $payments['status'] == 'Lunas')
            @endif
            <div class="card-body">
                <h4 class="mb-4 d-flex align-items-center">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Riwayat Pembayaran
                </h4>

                <p class="mb-4 text-muted">
                    Total Pembayaran Diterima: <span class="fw-semibold text-dark">{{ count($allPayments) }} kali</span>
                </p>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light text-dark">
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allPayments as $index => $pay)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pay['payment_date'])->format('d M Y') }}</td>
                                    <td class="text-success fw-semibold">Rp {{ number_format($pay['nominal']) }}</td>
                                    <td>
                                        <span class="badge rounded-pill 
                                            @if ($pay['status'] === 'Lunas') bg-success 
                                            @elseif($pay['status'] === 'Belum Lunas') bg-warning text-dark 
                                            @else bg-secondary @endif">
                                            {{ $pay['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        @if (!empty($pay['image']))
                                            <a href="{{ base_url('uploads/payments/' . esc($pay['image'])) }}" 
                                                target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i> Lihat
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak Ada</span>
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
