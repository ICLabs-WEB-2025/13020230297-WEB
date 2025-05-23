@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">Membership Card Details</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Name:</div>
                        <div class="col-sm-8">
                            <span class="h5">{{ $card->name }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Membership Number:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-primary fs-6">{{ $card->membership_number }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Joining Date:</div>
                        <div class="col-sm-8">
                            <span>{{ \Carbon\Carbon::parse($card->joining_date)->format('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Expiry Date:</div>
                        <div class="col-sm-8">
                            @if($card->expiry_date)
                            <span>{{ \Carbon\Carbon::parse($card->expiry_date)->format('d F Y') }}</span>
                            @php
                            $expiryDate = \Carbon\Carbon::parse($card->expiry_date);
                            $today = \Carbon\Carbon::now();
                            $daysUntilExpiry = $today->diffInDays($expiryDate, false);
                            @endphp
                            @if($daysUntilExpiry < 0)
                                <span class="badge bg-danger ms-2">Expired</span>
                                @elseif($daysUntilExpiry <= 30)
                                    <span class="badge bg-warning text-dark ms-2">Expires in {{ $daysUntilExpiry }} days</span>
                                    @else
                                    <span class="badge bg-success ms-2">Active</span>
                                    @endif
                                    @else
                                    <span class="text-muted">No expiry date</span>
                                    <span class="badge bg-info ms-2">Lifetime</span>
                                    @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Member Since:</div>
                        <div class="col-sm-8">
                            @php
                            $joiningDate = \Carbon\Carbon::parse($card->joining_date);
                            $memberSince = $joiningDate->diffForHumans();
                            @endphp
                            <span>{{ $memberSince }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Status:</div>
                        <div class="col-sm-8">
                            @if(!$card->expiry_date || \Carbon\Carbon::parse($card->expiry_date)->isFuture())
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Expired</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <div>
                            <!-- Button Generate/Print Member Card -->
                            <a href="{{ route('cards.print', $card->id) }}" class="btn btn-success" target="_blank">
                                <i class="fas fa-id-card"></i> Generate Member Card
                            </a>
                            <a href="{{ route('cards.download', $card->id) }}" class="btn btn-info">
                                <i class="fas fa-download"></i> Download Card
                            </a>
                            <a href="{{ route('membership_cards.edit', $card->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('membership_cards.destroy', $card->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this membership card?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection