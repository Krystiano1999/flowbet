@extends('layouts.app')

@section('title', 'Transakcje')

@section('content')
 
<div class="container p-3 bg-white">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-4">Transakcje</h1>
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
            Dodaj transakcje
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rodzaj</th>
                    <th>Kwota</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody class="transactions-list"></tbody>
        </table>
    </div>
</div>

@include('panel.transactions.modal.add_transactions')

@endsection

@push('scripts')
<script src="{{ asset('js/transactions.js') }}"></script>
@endpush