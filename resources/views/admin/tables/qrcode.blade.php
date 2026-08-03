@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>QR Code Meja {{ $tableId }}</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        {!! $qrCode !!}
                    </div>
                    <p>Scan QR code berikut untuk membuka menu pada meja <strong>{{ $tableId }}</strong>.</p>
                    <p>Link target: <a href="{{ $url }}" target="_blank">{{ $url }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
