@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">Edit Membership Card</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('membership_cards.update', $card->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $card->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="membership_number" class="form-label">Membership Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('membership_number') is-invalid @enderror" id="membership_number" name="membership_number" value="{{ old('membership_number', $card->membership_number) }}" required>
                            @error('membership_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="joining_date" class="form-label">Joining Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date', $card->joining_date) }}" required>
                            @error('joining_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="expiry_date" class="form-label">Expiry Date <span class="text-muted">(Optional)</span></label>
                            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $card->expiry_date) }}">
                            @error('expiry_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty for lifetime membership</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Membership Card
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection