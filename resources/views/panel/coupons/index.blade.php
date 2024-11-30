@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
 
<div class="container p-3 bg-white">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-4">Kupony</h1>
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addCouponModal">
            Dodaj kupon
        </button>
    </div>

    <div id="coupons-container" class="accordion"></div>
</div>

@include('panel.coupons.modal.add_coupon')

@endsection

@push('scripts')
<script src="{{ asset('js/coupons.js') }}"></script>
@endpush