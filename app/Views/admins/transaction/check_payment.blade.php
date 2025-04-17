@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0"><i class="bi bi-receipt"></i> Detail Pembayaran</h4>
        </div>
        <div class="card-body p-4">
            <div class="row align-items-center">
                @if ($payments)
                    <div class="col-md-6 mb-4 mb-md-0 text-center">
                        <img src="{{ base_url('uploads/payments/' . esc($payments['image'])) }}" 
                             alt="Bukti Pembayaran" 
                             class="img-thumbnail shadow-sm rounded-3" 
                             style="max-width: 100%; height: auto;">
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted mb-2"><i class="bi bi-calendar-event"></i> Tanggal Pembayaran</h5>
                        <p class="fs-5 fw-semibold">{{ $payments['payment_date'] }}</p>
                        <hr>
                        
                    </div>
                @else
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-exclamation-circle display-1 text-warning"></i>
                        <h3 class="mt-3 text-muted">Pembayaran Belum Ada</h3>
                        <p class="text-secondary">Silakan upload bukti pembayaran terlebih dahulu.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection