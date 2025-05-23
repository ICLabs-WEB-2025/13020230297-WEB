@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Member Card</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if (session('info'))
                    <div class="alert alert-info" role="alert">
                        {{ session('info') }}
                    </div>
                    @endif

                    @if ($card)
                    <div class="text-center mb-4">
                        <h3>Kartu Member Anda</h3>
                        <div class="my-3">
                            <img src="{{ asset('storage/' . $card->card_image_path) }}" class="img-fluid" alt="Member Card">
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('cards.download', $card->id) }}" class="btn btn-primary">
                                <i class="fa fa-download"></i> Download Kartu
                            </a>
                            <a href="{{ route('cards.print', $card->id) }}" class="btn btn-info ml-2" target="_blank">
                                <i class="fa fa-print"></i> Cetak Kartu
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="text-center">
                        <p>Anda belum memiliki kartu member. Klik tombol di bawah untuk membuat kartu.</p>
                        <form action="{{ route('cards.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Generate Kartu Member</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection