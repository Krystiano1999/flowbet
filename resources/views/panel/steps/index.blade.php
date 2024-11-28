@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
 
<div class="container p-3 bg-white">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-4">Kroki</h1>
        @if(auth()->user()->id == 1)
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addStepModal">
            Dodaj krok
        </button>
        @endif
    </div>

    <div id="steps-container" class="list-group"></div>
</div>

@include('panel.steps.modal.add_step')

@endsection

@push('scripts')
<script src="{{ asset('js/steps.js') }}"></script>
@endpush